<?php

RequirePage::model('Condition');
RequirePage::model('Timbre');
RequirePage::model('Image');

class ControllerTimbre extends Controller
{

    /**
     * Méthode pour afficher la page d'accueil. Affiche tous les projets en cours.
     */
    public function index()
    {
        Twig::render("/timbre/timbre-index.php");
    }

    /**
     * Méthode pour afficher le formulaire de création de timbre.
     */
    public function create()
    {
        CheckSession::sessionAuth();

        // Je dois aller chercher les types de conditions pour les afficher dans le formulaire
        $condition = new Condition;
        $conditions = $condition->select();

        Twig::render("/timbre/timbre-create.php",  ['conditions' => $conditions]);
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            RequirePage::redirect('timbre/timbre-create');
            exit();
        }
        extract($_POST);
        extract($_FILES);
        $validation = $this->validate();

        if ($validation->isSuccess()) {

            $timbre = new Timbre();
            $insert_id = $timbre->insert($_POST);


            foreach($_FILES["fileToUpload"]['name'] as $file) {
                $data['timbre_idTimbre'] = $insert_id;

                $data["nomImage"] = $file;
                $image = new Image;
                $image->insert($data);
            }
            for ($i=0; $i < count($_FILES["fileToUpload"]["name"]); $i++) { 
                $target_dir = "assets/img/public/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file);
            }

            // retour portail membre ou mettre ce timbre en enchere
            Twig::render("timbre/timbre-enchere.php",  ['timbre' => $insert_id]);
        } else {
            $errors = $validation->getErrors();
            $condition = new Condition;
            $conditions = $condition->select();
            Twig::render('timbre/timbre-create.php', ['errors' => $errors, 'conditions' => $conditions]);
        }
    }

    public function validate(){

        RequirePage::library('Validation');
        $val = new Validation();
        extract($_POST);

        // Validation timbre données
        $val->name('nomTimbre')->value($nomTimbre)->pattern('words')->max(30)->min(3)->required();
        $val->name('couleurs')->value($couleurs)->min(3)->max(100)->required();
        $val->name('paysOrigine')->value($paysOrigine)->pattern('words')->required()->max(50);
        $val->name('anneeEmission')->value($anneeEmission)->required()->pattern('year');
        $val->name('tirage')->value($tirage)->required()->pattern('int');
        $val->name('dimension')->value($dimension)->required();
        $val->name('certification')->value($certification)->required()->pattern('int')->min(1)->max(1);
        $val->name('condition_idCondition')->value($condition_idCondition)->required()->pattern('int')->min(1)->max(1);
        $val->name('membre_idMembre')->value($membre_idMembre)->required()->pattern('int');

        // Validation des images
        foreach ($_FILES["fileToUpload"]["name"] as $key => $value) {
            $fileSize = $_FILES["fileToUpload"]["size"][$key];
            if ($fileSize > 2000000) {
                $val->errors["images"] = "Une de vos photos est trop grande, la taille maximale autorisée est de 2MB.";
            }
        }
        return $val;
    }

    public function show(){
        CheckSession::sessionAuth();

        $timbre = new Timbre;
        $getTimbres = $timbre->select();

        // On veux aller cherche les images correspondant au timbre
        $image = new Image;

        foreach ($getTimbres as &$timbre) {
            $getImages = $image->selectId($timbre['idTimbre'], 'timbre_idTimbre');

            if($getImages){
                $timbre['images'] = $getImages[0]['nomImage'];
            } 
            else $timbre['images'] = false;
        }

 
        Twig::render('timbre/timbre-show.php', ['timbres' => $getTimbres]);
    }
}
