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
        Twig::render("membre/membre-portail.php");
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
            if($membre->checkUser($username, $password)){
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
        $val->name('username')->value($username)->pattern('text')->max(30)->min(3)->required();
        $val->name('password')->value($password)->pattern('alphanum')->min(6)->max(20)->required();
        $val->name('courriel')->value($courriel)->pattern('email')->required()->max(50);
        $val->name('dateInscription')->value($dateInscription)->required()->pattern('date_ymd');

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
        $val->name('username')->value($username)->pattern('text')->max(30)->min(3)->required();
        $val->name('password')->value($password)->pattern('alphanum')->min(6)->max(20)->required();

        if ($val->isSuccess()) {
            $membre = new Membre();
            if($membre->checkUser($username, $password)){
                $membre = $membre->selectId($username, 'username');
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
        $getEnchere = $encheres->joinTimbreEnchereById($_SESSION['idMembre'], 'membre_idMembre');
        var_dump($getEnchere);
        Twig::render("/membre/membre-enchere.php", ['encheres'=>$getEnchere]);
    }

    public function timbre(){
        CheckSession::sessionAuth();

        $timbre = new Timbre;
        $getTimbres = $timbre->selectId($_SESSION['idMembre'],'membre_idMembre');
        
        // On veux aller cherche les images correspondant au timbre
        $image = new Image;

        if ($getTimbres != false) {
            foreach ($getTimbres as &$timbre) {
                $getImages = $image->selectId($timbre['idTimbre'], 'timbre_idTimbre');
                // On doit verifier si le timbre est en enchere
                //$getEnchere = $timbre->selectId($timbre['idTimbre'], 'timbre_idTimbre');
                // Si le timbre est en enchere
                if($getImages){
                    $timbre['images'] = $getImages[0]['nomImage'];
                } 
                else $timbre['images'] = false;
            }
        }
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
