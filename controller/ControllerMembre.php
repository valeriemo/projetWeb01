<?php
RequirePage::model('Membre');


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
        RequirePage::library('Validation');
        $val = new Validation();

        $val->name('username')->value($username)->pattern('text')->max(30)->min(3)->required();
        $val->name('password')->value($password)->pattern('alphanum')->min(6)->max(20)->required();
        $val->name('courriel')->value($courriel)->pattern('email')->required()->max(50);
        $val->name('dateInscription')->value($dateInscription)->required()->pattern('date_ymd');

        if ($val->isSuccess()) {
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
                // On voudrait afficher le portail membre avec bienvenue
                Twig::render("membre/membre-portail.php",  ['membre' => $select]);
            }
            
        } else {
            $errors = $val->displayErrors();
            Twig::render('membre/membre-create.php', ['errors' => $errors]);
        }
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
        // Pourquoi ca marche pas avec un courriel ??
        //$val->name('username')->value($username)->pattern('email')->required()->max(50);
        $val->name('password')->value($password)->pattern('alphanum')->min(6)->max(20)->required();

        if ($val->isSuccess()) {
            $membre = new Membre();
            if($membre->checkUser($username, $password)){
                // On voudrait rediriger le membre vers son portail
                Twig::render("membre/membre-portail.php");
            }else{
                RequirePage::redirect('home/error');
            }
        }else {
            $errors = $val->displayErrors();
            Twig::render('membre/login.php', ['errors'=>$errors, 'data'=>$_POST]);
        }
    }














    /**
     * Méthode pour déconnecter un utilisateur
     */
    public function logout(){
        session_destroy();
        RequirePage::redirect('home/index');
    }
}
