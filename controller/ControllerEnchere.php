<?php
RequirePage::model('Enchere');
RequirePage::model('mise');
RequirePage::model('Image');

class ControllerEnchere extends Controller
{
    /**
     * Méthode pour afficher la page d'accueil. Affiche tous les projets en cours.
     */
    public function index()
    {
        Twig::render("/enchere/enchere-index.php");
    }

    /**
     * Méthode pour afficher la page de tous les encheres.
     */
    public function show(){
        $encheres = new Enchere;
        // On va chercher les encheres 
        $getEncheres = $encheres->joinTimbreEnchere();
        Twig::render("/enchere/enchere-show.php", ['encheres'=>$getEncheres]);
    }

    /**
     * Méthode pour afficher la page d'un timbre en enchere.
     */
    public function timbre($id) {
        // on a besoin des infos du timbre et de l'enchere
        $enchere = new Enchere;
        $getEnchere = $enchere->joinTimbreEnchereById($id, 'idEnchere');
        // on a besoin de la condition du timbre
        RequirePage::model('Condition');
        $condition = new Condition;
        // on doit aller chercher les images du timbre
        $images = new Image;
        $idTimbre = $getEnchere[0]['timbre_idTimbre'];
        $getImages = $images->getImageById($idTimbre);
        $getCondition = $condition->getCondition($getEnchere[0]['condition_idCondition']);
        Twig::render("/enchere/enchere-timbre.php", ['enchere'=>$getEnchere, 'condition'=>$getCondition, 'images'=>$getImages]);
    }

    /**
     * Méthode pour afficher la page de création d'une enchere.
     */
    public function create($id)
    {
        CheckSession::sessionAuth();
        Twig::render("/enchere/enchere-create.php", ['timbre_idTimbre' => $id]);
    }

    /**
     * Méthode pour enregistrer l'enchere.
     */
    public function store(){
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            RequirePage::redirect('enchere/enchere-create');
            exit();
        }
        $validation = $this->validate();


        $id = $_POST['timbre_idTimbre'];

        if ($validation->isSuccess()) {
            // je doit verifier si existe deja TIMBRE_idTimbre dans enchere doit etre unique

            $enchere = new Enchere;
            $enchere->insert($_POST);
            Twig::render("membre/membre-portail.php");
        } else {
            $errors = $validation->getErrors();
            Twig::render("/enchere/enchere-create.php", ['errors' => $errors, 'timbre_idTimbre' => $id]);
        }
    }

    /**
     * Méthode pour valider les données du formulaire.
     */
    public function validate(){
        RequirePage::library('Validation');
        $val = new Validation();
        extract($_POST);

        $val->name('dateDebut')->value($_POST['dateDebut'])->pattern('date_ymd')->required();
        $val->name('dateFin')->value($_POST['dateFin'])->pattern('date_ymd')->required();
        $val->name('prixPlancher')->value($_POST['prixPlancher'])->pattern('float')->required();
        $val->name('timbre_idTimbre')->value($_POST['timbre_idTimbre'])->pattern('int')->min(1)->max(5)->required();
        $val->name('membre_idMembre')->value($_POST['membre_idMembre'])->pattern('int')->min(1)->max(5)->required();
        return $val;
    }

    public function mise($id){
        CheckSession::sessionAuth();
        // On doit aller chercher l'enchere avec le timbre
        $enchere = new Enchere;
        $getEnchere = $enchere->joinTimbreEnchereById($id, 'idEnchere');
        Twig::render("enchere/enchere-mise.php", ['enchere'=>$getEnchere]);
    }

    public function addmise(){
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            RequirePage::redirect('enchere/enchere-mise');
            exit();
        }
        // Valide le prix de la mise
        RequirePage::library('Validation');
        $val = new Validation();
        $val->name('prixOffre')->value($_POST['prixOffre'])->required();
        $id = $_POST['enchere_idEnchere'];
        if ($val->isSuccess()) {
            $mise = new Mise;
            $mise->insert($_POST);
            RequirePage::redirect('enchere/timbre/'.$id);
        } else {
            $errors = $val->getErrors();
            $enchere = new Enchere;
            $getEnchere = $enchere->joinTimbreEnchereById($id, 'idEnchere');
            Twig::render("enchere/enchere-mise.php", ['errors' => $errors, 'enchere'=>$getEnchere]);
        }
    }


}