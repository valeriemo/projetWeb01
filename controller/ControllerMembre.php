<?php
RequirePage::model('Membre');


class ControllerMembre extends Controller
{

    /**
     * Méthode pour afficher la page d'accueil. Affiche tous les projets en cours.
     */
    public function index()
    {
        Twig::render("home-index.php");
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
     * Envoi du mail de bienvenue
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

            // On veux le rediriger vers une page de connexion qu'il se connecte 
            Twig::render('home-index.php', ['membre' => $select]);
        } else {
            $errors = $val->displayErrors();
            Twig::render('membre/membre-create.php', ['errors' => $errors]);
        }
    }
}
