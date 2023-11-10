<?php
RequirePage::model('Enchere');
RequirePage::model('Mise');
RequirePage::model('Image');
RequirePage::model('Favoris');

class ControllerEnchere extends Controller
{

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
        $condition = new Condition;
        $conditions = $condition->getAllCondition();
        Twig::render("/enchere/enchere-show.php", ['encheres' => $getEncheres, 'conditions' => $conditions]);
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
        $condition = new Condition;
        $conditions = $condition->getAllCondition();
        Twig::render("/enchere/enchere-archive.php", ['encheres' => $enchereArchive, 'conditions' => $conditions]);
    }

    /**
     * Méthode pour rechercher un enchere par nom, pays ou prix
     */
    public function search()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            RequirePage::redirect('enchere/enchere-mise');
            exit();
        }
        $data = $_POST;
        // Recherche par prix
        if (isset($data['prixMin'])) {
            $message = 'Résultat de la recherche par prix: ' . $data['prixMin'] . ' $ à ' . $data['prixMax'] . ' $';
            $prixMin = $data['prixMin'];
            $prixMax = $data['prixMax'];
            $encheres = new Enchere;
            $getEncheres = $encheres->joinTimbreEnchere();
            $searchResult = [];
            foreach ($getEncheres as $enchere) {
                if ($enchere['prixMax'] == null) {
                    if ($enchere['prixPlancher'] >= $prixMin && $enchere['prixPlancher'] <= $prixMax) {
                        $searchResult[] = $enchere;
                    }
                } else {
                    if ($enchere['prixMax'] >= $prixMin && $enchere['prixMax'] <= $prixMax) {
                        $searchResult[] = $enchere;
                    }
                }
            }
            $condition = new Condition;
            $conditions = $condition->getAllCondition();
            Twig::render("/enchere/enchere-show.php", ['encheres' => $searchResult, 'conditions' => $conditions, 'message' => $message]);
        }

        // Recherche par nom ou pays
        foreach ($data as $key => $value) {
            $where = $key;
            $search = $value;
        }
        if ($where == 'nomTimbre') {
            $message = 'Résultat de la recherche par nom: ' . $search;
        } else {
            $message = 'Résultat de la recherche par pays d\'origine: ' . $search;
        }
        $encheres = new Enchere;
        $getEncheres = $encheres->joinTimbreEnchere();
        $searchResult = [];
        foreach ($getEncheres as $enchere) {
            if ($enchere[$where] == $search) {
                $searchResult[] = $enchere;
            }
        }
        $condition = new Condition;
        $conditions = $condition->getAllCondition();
        Twig::render("/enchere/enchere-show.php", ['encheres' => $searchResult, 'conditions' => $conditions, 'message' => $message]);
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

        if (isset($_POST['dateDebut'])) {
            $val->name('dateDebut')->value($_POST['dateDebut'])->pattern('date_ymd')->required()->isDatePassed($_POST['dateDebut']);
        }
        if (isset($_POST['dateFin'])) {
            $val->name('dateFin')->value($_POST['dateFin'])->pattern('date_ymd')->required()->compareDate($_POST['dateDebut'], $_POST['dateFin']);
        }
        if (isset($_POST['prixPlancher'])) {
            $val->name('prixPlancher')->value($_POST['prixPlancher'])->required();
        }
        if (isset($_POST['coupDeCoeur'])) {
            $val->name('coupDeCoeur')->value($_POST['coupDeCoeur'])->pattern('int')->min(0)->max(1)->required();
        }
        if (isset($_POST['timbre_idTimbre'])) {
            $val->name('timbre_idTimbre')->value($_POST['timbre_idTimbre'])->pattern('int')->min(1)->max(5)->required();
        }
        if (isset($_POST['membre_idMembre'])) {
            $val->name('membre_idMembre')->value($_POST['membre_idMembre'])->pattern('int')->min(1)->max(5)->required();
        }
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
        $getEnchere = $this->getPrice20($getEnchere);

        Twig::render("enchere/enchere-mise.php", ['enchere' => $getEnchere]);
    }

    /**
     * Méthode pour calculer le prix suggéré
     */
    public function getPrice20($getEnchere)
    {
        // On propose 20% de plus que le prix actuel
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
        return $getEnchere;
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
        // On doit vérifier si le membre n'est pas le propriétaire de l'enchere
        $id = $_POST['enchere_idEnchere'];
        $enchere = new Enchere;
        $checkId = $enchere->getIdMembre($id);
        if ($checkId == $_SESSION['idMembre']) {
            $errors['idMembre'] = "Vous ne pouvez pas miser sur votre propre enchère";
            $enchere = new Enchere;
            $getEnchere = $enchere->joinTimbreEnchereById($id, 'idEnchere');
            $getEnchere = $this->getPrice20($getEnchere);
            $errors = $errors ?? [];
            Twig::render("enchere/enchere-mise.php", ['errors' => $errors, 'enchere' => $getEnchere]);
            exit();
        }
        RequirePage::library('Validation');
        $val = new Validation();
        $val->name('prixOffre')->value($_POST['prixOffre'])->required()->pattern('float');
        RequirePage::model('Mise');
        $mise = new Mise;
        $getMise = $mise->getMaxPriceById($id);

        $errors = [];
        if ($_POST['prixOffre'] <= $getMise['MAX(`prixOffre`)']) {
            $errors[] = 'Votre mise doit être plus élevée que la dernière mise';
        }

        if ($val->isSuccess() && empty($errors)) {
            $mise = new Mise;
            $mise->insert($_POST);
            RequirePage::redirect('enchere/timbre/' . $id);
        } else {
            // On doit aller chercher l'enchere avec le timbre
            $enchere = new Enchere;
            $getEnchere = $enchere->joinTimbreEnchereById($id, 'idEnchere');
            $getEnchere = $this->getPrice20($getEnchere);
            $errors = $errors ?? [];
            Twig::render("enchere/enchere-mise.php", ['errors' => $errors, 'enchere' => $getEnchere]);
        }
    }


    public function edit($idEnchere)
    {
        CheckSession::sessionAuth();
        $enchere = new Enchere;
        $getEnchere = $enchere->joinTimbreEnchereById($idEnchere, 'idEnchere');
        if ($getEnchere['status'] == 'archive') {
            $errors['status'] = "Vous ne pouvez pas modifier une enchère archivée";
            Twig::render("enchere/enchere-edit.php", ['errors' => $errors, 'enchere' => $getEnchere]);
            exit();
        }
        Twig::render("enchere/enchere-edit.php", ['enchere' => $getEnchere]);
    }

    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            RequirePage::redirect('enchere/enchere-mise');
            exit();
        }
        extract($_POST);
        $validation = $this->validate();

        if ($validation->isSuccess()) {
            var_dump($_POST);
            $enchere = new enchere();
            $enchere->update($_POST);
            RequirePage::redirect('membre/enchere');
        } else {
            $errors = $validation->getErrors();
            Twig::render("enchere/enchere-edit.php", ['errors' => $errors]);
        }
    }
}
