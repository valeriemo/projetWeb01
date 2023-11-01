<?php
RequirePage::model('Enchere');



class ControllerEnchere extends Controller
{

    /**
     * Méthode pour afficher la page d'accueil. Affiche tous les projets en cours.
     */
    public function index()
    {
        Twig::render("/enchere/enchere-index.php");
    }

    public function create($id)
    {
        CheckSession::sessionAuth();
        Twig::render("/enchere/enchere-create.php", ['timbre_idTimbre' => $id]);
    }

    public function store(){
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            RequirePage::redirect('enchere/enchere-create');
            exit();
        }
        $validation = $this->validate();

        if ($validation->isSuccess()) {
            $enchere = new Enchere;
            $enchere->insert($_POST);
            Twig::render("membre/membre-portail.php");
        } else {
            $errors = $validation->getErrors();
            Twig::render("/enchere/enchere-create.php", ['errors' => $errors]);
        }
    }

    public function validate(){
        RequirePage::library('Validation');
        $val = new Validation();
        extract($_POST);

        $val->name('dateDebut')->value($_POST['dateDebut'])->pattern('date_ymd')->required();
        $val->name('dateFin')->value($_POST['dateFin'])->pattern('date_ymd')->required();
        $val->name('prixPlancher')->value($_POST['prixPlancher'])->pattern('float')->required();
        $val->name('status_idStatus')->value($_POST['status_idStatus'])->pattern('int')->min(1)->max(1)->required();
        $val->name('timbre_idTimbre')->value($_POST['timbre_idTimbre'])->pattern('int')->min(1)->max(5)->required();
        $val->name('membre_idMembre')->value($_POST['membre_idMembre'])->pattern('int')->min(1)->max(5)->required();
        return $val;
    }
}