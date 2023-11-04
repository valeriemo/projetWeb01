<?php
RequirePage::model('Membre');
RequirePage::model('Enchere');
RequirePage::model('Timbre');
RequirePage::model('Image');

class ControllerMembre extends Controller
{
    /**
     * Méthode pour afficher la page d'accueil. Affiche tous les projets en cours.
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
            if($membre->checkUser($courriel, $password)){
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
    public function validate(){
        RequirePage::library('Validation');
        extract($_POST);
        $val = new Validation();
        $val->name('password')->value($password)->pattern('alphanum')->min(6)->max(20)->required();
        $val->name('courriel')->value($courriel)->pattern('email')->required()->max(50);
        $val->name('dateInscription')->value($dateInscription)->required()->pattern('date_ymd');
        $val->name('nom')->value($nom)->pattern('text')->max(30)->min(3)->required();
        $val->name('prenom')->value($prenom)->pattern('text')->max(30)->min(3)->required();

        return $val;
    }

    /**
     * Méthode pour afficher la page d'identification du membre
     */
    public function login(){
        Twig::render('membre/login.php');
    }

    /**
     * Méthode pour authentifier un utilisateur et le rediriger vers la page d'accueil 
     */
    public function auth(){
        if ($_SERVER["REQUEST_METHOD"] != "POST"){
            RequirePage::redirect('home/index');
            exit();
        }
        extract($_POST);
        RequirePage::library('Validation');
        $val = new Validation();
        $val->name('courriel')->value($courriel)->pattern('email')->max(50)->min(3)->required();
        $val->name('password')->value($password)->pattern('alphanum')->min(6)->max(20)->required();

        if ($val->isSuccess()) {
            $membre = new Membre();
            if($membre->checkUser($courriel, $password)){
                $membre = $membre->selectId($courriel, 'courriel');
                Twig::render("membre/membre-portail.php", ['membre'=>$membre]);
            }else{
                RequirePage::redirect('home/error');
            }
        }else {
            $errors = $val->getErrors();
            Twig::render('membre/login.php', ['errors'=>$errors, 'data'=>$_POST]);
        }
        
    }

    /**
     * Méthode pour afficher les echères en cours d'un membre
     */
    public function enchere(){
        CheckSession::sessionAuth();
        $encheres = new Enchere;
        $getEnchere = $encheres->getTimbreIfEnchere($_SESSION['idMembre']);
        Twig::render("/membre/membre-enchere.php", ['encheres'=>$getEnchere]);
    }

    /**
     * Méthode pour afficher les timbres d'un membre qui ne sont pas encore en enchère
     */
    public function timbre(){
        CheckSession::sessionAuth();
        $timbre = new Timbre;
        // On veux seulement aller chercher les timbres qui ne sont pas encore mis en enchere
        $getTimbres = $timbre->getTimbreNotInEnchere($_SESSION['idMembre']);
        Twig::render('membre/membre-timbre.php', ['timbres' => $getTimbres]);
    }


    /**
     * Méthode pour déconnecter un utilisateur
     */
    public function logout(){
        session_destroy();
        RequirePage::redirect('home/index');
    }
}
