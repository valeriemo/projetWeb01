<?php
RequirePage::model('Membre');
RequirePage::model('Enchere');
RequirePage::model('Timbre');
RequirePage::model('Image');
RequirePage::library('Validation');


class ControllerMembre extends Controller
{
    /**
     * Méthode pour afficher la page de portail d'un membre
     */
    public function index()
    {
        CheckSession::sessionAuth();
        $membre = new Membre;
        $membre = $membre->selectId($_SESSION['idMembre'], 'idMembre');

        Twig::render("membre/membre-portail.php", ['membre' => $membre]);
    }

    /**
     * Méthode pour afficher le formulaire de création d'un membre.
     */
    public function create()
    {
        Twig::render("membre/membre-create.php");
    }

    /**
     * Méthode pour traiter la soumission du formulaire de création d'un client
     * Hachage du mot de passe
     */
    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            RequirePage::redirect('membre/membre-create');
            exit();
        }
        extract($_POST);
        $val = $this->validate();

        if ($val->isSuccess()) {
            // verification si le courriel existe deja
            $membre = new Membre();
            $checkCourriel = $membre->selectId($courriel, 'courriel');
            if ($checkCourriel) {
                $errors = ['Le courriel existe déjà'];
                Twig::render('membre/membre-create.php', ['errors' => $errors]);
                exit();
            }

            // creation du membre
            $membre = new Membre();
            $options = [
                'cost' => 10,
            ];
            $hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);
            $_POST['password'] = $hashPassword;
            $insert = $membre->insert($_POST);
            $select = $membre->selectId($insert, 'idMembre');

            // Une fois le membre créé, on le connecte automatiquement
            if ($membre->checkUser($courriel, $password)) {
                Twig::render("membre/membre-portail.php",  ['membre' => $select]);
            }
        } else {
            $errors = $val->getErrors();
            Twig::render('membre/membre-create.php', ['errors' => $errors]);
        }
    }

    /**
     * Méthode pour valider les données du formulaire de création d'un membre
     */
    public function validate()
    {
        extract($_POST);
        $val = new Validation();
        if(isset($_POST['password'])){
            $val->name('password')->value($password)->pattern('alphanum')->min(6)->max(20)->required();
        }
        if(isset($_POST['courriel'])){
            $val->name('courriel')->value($courriel)->pattern('email')->required()->max(50);
        }
        if(isset($_POST['dateInscription'])){
            $val->name('dateInscription')->value($dateInscription)->required()->pattern('date_ymd');
        }
        if(isset($_POST['nom'])){
            $val->name('nom')->value($nom)->pattern('text')->max(30)->min(3)->required();
        }
        if(isset($_POST['prenom'])){
            $val->name('prenom')->value($prenom)->pattern('text')->max(30)->min(3)->required();
        }
        return $val;
    }

    /**
     * Méthode pour afficher la page d'identification du membre
     */
    public function login()
    {
        Twig::render('membre/login.php');
    }

    /**
     * Méthode pour authentifier un utilisateur et le rediriger vers la page d'accueil 
     */
    public function auth()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            RequirePage::redirect('home/index');
            exit();
        }
        extract($_POST);
        $val = new Validation();
        $val->name('courriel')->value($courriel)->pattern('email')->max(50)->min(3)->required();
        $val->name('password')->value($password)->pattern('alphanum')->min(6)->max(20)->required();
        if ($val->isSuccess()) {
            $membre = new Membre();
            if ($membre->checkUser($courriel, $password)) {
                $membre = $membre->selectId($courriel, 'courriel');
                Twig::render("membre/membre-portail.php", ['membre' => $membre]);
            } else {
                $errors = ['Le courriel ou le mot de passe est invalide'];
                Twig::render('membre/login.php', ['errors' => $errors, 'data' => $_POST]);
            }
        } else {
            $errors = $val->getErrors();
            Twig::render('membre/login.php', ['errors' => $errors, 'data' => $_POST]);
        }
    }

    /**
     * Méthode pour afficher les echères en cours d'un membre
     */
    public function enchere()
    {
        CheckSession::sessionAuth();
        $encheres = new Enchere;
        $getEnchere = $encheres->getTimbreIfEnchere($_SESSION['idMembre']);
        Twig::render("/membre/membre-enchere.php", ['encheres' => $getEnchere]);
    }

    /**
     * Méthode pour afficher les timbres d'un membre qui ne sont pas encore en enchère
     */
    public function timbre()
    {
        CheckSession::sessionAuth();
        $timbre = new Timbre;
        // On veux seulement aller chercher les timbres qui ne sont pas encore mis en enchere
        $getTimbres = $timbre->getTimbreNotInEnchere($_SESSION['idMembre']);
        Twig::render('membre/membre-timbre.php', ['timbres' => $getTimbres]);
    }

    /**
     * Méthode pour afficher les favoris d'un membre
     */
    public function favoris()
    {
        CheckSession::sessionAuth();
        RequirePage::model('Favoris');
        $favoris = new Favoris;
        $getFavoris = $favoris->selectAllById('membre_idMembre', $_SESSION['idMembre']);
        if ($getFavoris == 'Nothing') {
            $message = ['Vous n\'avez pas de favoris'];
            Twig::render('membre/membre-favoris.php', ['message' => $message]);
            exit();
        } else {
            // on doit aller chercher les info des encheres favorites
            $getEncheres = [];
            foreach ($getFavoris as $favoris) {
                $encheres = new Enchere;
                $enchere = $encheres->joinTimbreEnchereById($favoris['enchere_idEnchere'], 'idEnchere');
                $getEncheres[] = $enchere;
            }
            Twig::render('membre/membre-favoris.php', ['encheres' => $getEncheres]);
        }
    }

    /**
     * Méthode pour afficher l'historique des mises d'un membre
     */
    public function mises(){
        CheckSession::sessionAuth();
        RequirePage::model('Mise');
        $mises = new Mise;
        $getMises = $mises->selectAllById('membre_idMembre', $_SESSION['idMembre']);
        if ($getMises == 'Nothing') {
            $message = ['Vous n\'avez pas de mises'];
            Twig::render('membre/membre-mises.php', ['message' => $message]);
            exit();
        } else{
            // on doit aller chercher les info des mises
            foreach ($getMises as &$mise) {
                $encheres = new Enchere;
                $enchere = $encheres->joinTimbreEnchereById($mise['enchere_idEnchere'], 'idEnchere');
                $mise['enchere'] = $enchere;
            }
        }
        Twig::render('membre/membre-mises.php', ['mises' => $getMises]);
    }

    public function edit($id){
        CheckSession::sessionAuth();
        $membre = new Membre;
        $getMembre = $membre->selectId($_SESSION['idMembre'], 'idMembre');
        Twig::render('membre/membre-edit.php', ['membre' => $getMembre]);
    }

    public function update(){
        CheckSession::sessionAuth();
        $membre = new Membre;
        $data = $_POST;
        foreach ($data as $key => $value) {
            $fieldName = $key;
            $fieldValue = $value;
        }
        $val = $this->validate($_POST);
        if ($val->isSuccess()){
            $update = $membre->updateMembre($_SESSION['idMembre'], $fieldName, $fieldValue);
            if($update){
                $message = 'Votre profil a été mis à jour';
                $getMembre = $membre->selectId($_SESSION['idMembre'], 'idMembre');
                Twig::render('membre/membre-edit.php', ['membre' => $getMembre, 'message' => $message]);
            }
        } else {
            $errors = $val->getErrors();
            $getMembre = $membre->selectId($_SESSION['idMembre'], 'idMembre');
            Twig::render('membre/membre-edit.php', ['membre' => $getMembre, 'errors' => $errors]);
        }

    }

    public function delete($id){
        CheckSession::sessionAuth();
        $membre = new Membre;
        $delete = $membre->delete($id, 'idMembre');
        if($delete){
            RequirePage::redirect('membre/login');
        }
    }
    

    /**
     * Méthode pour déconnecter un utilisateur
     */
    public function logout()
    {
        session_destroy();
        RequirePage::redirect('home/index');
    }
}
