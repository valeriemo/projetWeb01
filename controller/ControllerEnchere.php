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

    public function show(){
        $encheres = new Enchere;
        // On va vouloir inner join la table enchere et timbre pour afficher les infos du timbre
        $getEncheres = $encheres->joinTimbreEnchere();
        var_dump($getEncheres);
        Twig::render("/enchere/enchere-show.php", ['encheres'=>$getEncheres]);
    }

    /**
     * Méthode pour miser sur un timbre.
     */
    public function miser($id){
        if ($_SERVER["REQUEST_METHOD"] != "POST"){
            RequirePage::redirect('home/index');
            exit();
        }
        CheckSession::sessionAuth();
        $mise = new Mise;
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
        $image = new Image;
        $getImages = $image->getImageById($id);
        $getCondition = $condition->getCondition($getEnchere[0]['condition_idCondition']);
        Twig::render("/enchere/enchere-timbre.php", ['enchere'=>$getEnchere, 'condition'=>$getCondition, 'images'=>$getImages]);
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

        $id = $_POST['timbre_idTimbre'];
        if ($validation->isSuccess()) {
            $enchere = new Enchere;
            $enchere->insert($_POST);
            Twig::render("membre/membre-portail.php");
        } else {
            $errors = $validation->getErrors();
            Twig::render("/enchere/enchere-create.php", ['errors' => $errors, 'timbre_idTimbre' => $id]);
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