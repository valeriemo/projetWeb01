<?php
RequirePage::model('Enchere');
RequirePage::model('mise');
RequirePage::model('Image');
RequirePage::model('Favoris');

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
    public function show()
    {
        $encheres = new Enchere;
        // On va chercher les encheres 
        $getEncheres = $encheres->joinTimbreEnchere();
        // on doit aller chercher les favoris du membre si connecté
        if (CheckSession::sessionCheck()) {
            $favoris = new Favoris;
            foreach ($getEncheres as $key => $value) {
                $getEncheres[$key]['favoris'] = $favoris->getFavorisById($value['idEnchere']);
            }
        }
        Twig::render("/enchere/enchere-show.php", ['encheres' => $getEncheres]);
    }

    /**
     * Méthode pour afficher la page des encheres archivés.
     */
    public function archive()
    {
        $encheres = new Enchere;
        // On va chercher les encheres 
        $getEncheres = $encheres->joinTimbreEnchere();
        // on devrait aller chercher les encheres ayant le statut archive
        $enchereArchive = [];
        foreach ($getEncheres as $enchere) {
            if ($enchere['status'] == 'archive') {
                $enchereArchive[] = $enchere;
            }
        }
        Twig::render("/enchere/enchere-archive.php", ['encheres' => $enchereArchive]);
    }


    /**
     * Méthode pour ajouter un enchere dans ses favoris
     */
    public function favoris($id)
    {
        CheckSession::sessionAuth();
        $membre_idMembre = $_SESSION['idMembre'];
        $enchere_idEnchere = $id;
        RequirePage::model('Favoris');
        $favoris = new Favoris;
        $favoris->insert(['membre_idMembre' => $membre_idMembre, 'enchere_idEnchere' => $enchere_idEnchere]);
        RequirePage::redirect('enchere/timbre/' . $id);
    }

    /**
     * Méthode pour retirer un enchere de ses favoris
     */
    public function favdelete($id)
    {
        CheckSession::sessionAuth();
        $membre_idMembre = $_SESSION['idMembre'];
        $enchere_idEnchere = $id;
        $favoris = new Favoris;
        $favoris->deleteFavoris($membre_idMembre, $enchere_idEnchere);
        RequirePage::redirect('enchere/timbre/' . $enchere_idEnchere);
    }
    /**
     * Méthode pour afficher la page d'un timbre en enchere.
     */
    public function timbre($id)
    {
        // on a besoin des infos du timbre et de l'enchere
        $enchere = new Enchere;
        $getEnchere = $enchere->joinTimbreEnchereById($id, 'idEnchere');
        // on doit aller chercher les images du timbre
        $images = new Image;
        $idTimbre = $getEnchere['timbre_idTimbre'];
        $getImages = $images->getImageById($idTimbre);
        // on doit vérifier si le membre a mis l'enchere dans ses favoris seulement si connecté
        if (CheckSession::sessionCheck()) {
            $favoris = new Favoris;
            $getEnchere['favoris'] = $favoris->getFavorisById($id);
        }
        Twig::render("/enchere/enchere-timbre.php", ['enchere' => $getEnchere, 'images' => $getImages]);
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
    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            RequirePage::redirect('enchere/enchere-create');
            exit();
        }
        $validation = $this->validate();
        $id = $_POST['timbre_idTimbre'];
        if ($validation->isSuccess()) {
            // je doit verifier si existe deja TIMBRE_idTimbre dans enchere doit etre unique
            $enchere = new Enchere;
            $check = $enchere->selectId($_POST['timbre_idTimbre'], 'timbre_idTimbre');
            if ($check) {
                $errors['timbre_idTimbre'] = "Vous avez déjà une enchère pour ce timbre";
                Twig::render("/enchere/enchere-create.php", ['errors' => $errors, 'timbre_idTimbre' => $id]);
                exit();
            }
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
    public function validate()
    {
        RequirePage::library('Validation');
        $val = new Validation();
        extract($_POST);

        $val->name('dateDebut')->value($_POST['dateDebut'])->pattern('date_ymd')->required();
        $val->name('dateFin')->value($_POST['dateFin'])->pattern('date_ymd')->required();
        $val->name('prixPlancher')->value($_POST['prixPlancher'])->required();
        $val->name('timbre_idTimbre')->value($_POST['timbre_idTimbre'])->pattern('int')->min(1)->max(5)->required();
        $val->name('membre_idMembre')->value($_POST['membre_idMembre'])->pattern('int')->min(1)->max(5)->required();
        return $val;
    }

    /**
     * Méthode pour afficher la page de mise d'une enchere.
     */
    public function mise($id)
    {
        CheckSession::sessionAuth();
        // On doit aller chercher l'enchere avec le timbre
        $enchere = new Enchere;
        $getEnchere = $enchere->joinTimbreEnchereById($id, 'idEnchere');

        // On doit aller chercher la dernière mise
        $mise = new Mise;
        $getMise = $mise->getMaxPriceById($id);
        $getEnchere['prixMax'] = $getMise['MAX(`prixOffre`)'];
        if ($getEnchere['prixMax'] == null) {
            $prixSuggerer = $getEnchere['prixPlancher'];
            // Calculer 20% du prix actuel
            $augmentation = $prixSuggerer * 0.20;
            // Ajouter l'augmentation au prix actuel
            $prixSuggerer = $prixSuggerer + $augmentation;
        } else {
            $prixSuggerer = $getEnchere['prixMax'];
            $augmentation = $prixSuggerer * 0.20;
            $prixSuggerer = $prixSuggerer + $augmentation;
            $prixSuggerer = number_format($prixSuggerer, 2, '.', '');
        }
        $getEnchere['prixSuggerer'] = $prixSuggerer;
        Twig::render("enchere/enchere-mise.php", ['enchere' => $getEnchere]);
    }

    /**
     * Méthode pour ajouter une mise dans une enchere
     */
    public function addmise()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            RequirePage::redirect('enchere/enchere-mise');
            exit();
        }
        RequirePage::library('Validation');
        $val = new Validation();
        $val->name('prixOffre')->value($_POST['prixOffre'])->required();
        $id = $_POST['enchere_idEnchere'];
        if ($val->isSuccess()) {
            $mise = new Mise;
            $mise->insert($_POST);
            RequirePage::redirect('enchere/timbre/' . $id);
        } else {
            $errors = $val->getErrors();
            $enchere = new Enchere;
            $getEnchere = $enchere->joinTimbreEnchereById($id, 'idEnchere');
            if ($getEnchere['prixMax'] == null) {
                $prixSuggerer = $getEnchere['prixPlancher'];
                // Calculer 20% du prix actuel
                $augmentation = $prixSuggerer * 0.20;
                // Ajouter l'augmentation au prix actuel
                $prixSuggerer = $prixSuggerer + $augmentation;
            } else {
                $prixSuggerer = $getEnchere['prixMax'];
                $augmentation = $prixSuggerer * 0.20;
                $prixSuggerer = $prixSuggerer + $augmentation;
                $prixSuggerer = number_format($prixSuggerer, 2, '.', '');
            }
            $getEnchere['prixSuggerer'] = $prixSuggerer;
            Twig::render("enchere/enchere-mise.php", ['errors' => $errors, 'enchere' => $getEnchere]);
        }
    }
}
