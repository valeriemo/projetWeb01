<?php
//require_once('Crud.php');
RequirePage::core("Crud");

class Enchere extends Crud
{

    public $table = 'st_enchere';
    public $primaryKey = 'idEnchere';
    public $foreignKey2 = 'timbre_idTimbre';
    public $foreignKey3 = 'membre_idMembre';

    public $fillable = [
        'idEnchere',
        'dateDebut',
        'dateFin',
        'prixPlancher',
        'coupDeCoeur',
        'timbre_idTimbre',
        'membre_idMembre'
    ];

    /**
     * Méthode pour aller chercher toutes les enchères d'un membre
     * Retoune un tableau d'enchères
     */
    public function getTimbreIfEnchere($idMembre)
    {
        $sql = "SELECT * FROM st_timbre RIGHT JOIN st_enchere ON st_timbre.idTimbre = st_enchere.timbre_idTimbre WHERE st_timbre.membre_idMembre = $idMembre ORDER BY st_enchere.dateFin ASC;";
        $stmt = $this->query($sql);
        $encheres = $stmt->fetchAll();
        // On va calculer le temps restant
        foreach ($encheres as &$enchere) {
            $enchere = $this->getData($enchere);
        }
        return $encheres;
    }

    /**
     * Méthode pour aller chercher toutes les enchères avec le timbre
     * Retourne un tableau d'enchères
     */
    public function joinTimbreEnchere()
    {
        $sql = "SELECT * FROM $this->table JOIN st_timbre ON st_timbre.idTimbre = st_enchere.timbre_idTimbre ORDER BY st_enchere.dateFin ASC";
        $stmt = $this->query($sql);
        $encheres = $stmt->fetchAll();
        // On va calculer le temps restant
        foreach ($encheres as &$enchere) {
            $enchere = $this->getData($enchere);
        }
        return $encheres;
    }


    /**
     *  Méthode pour aller cherche une enchere avec son timbre par ID 
     *  Return 1 enchere
     * 
     */
    public function joinTimbreEnchereById($idEnchere, $where)
    {
        $sql = "SELECT * FROM $this->table INNER JOIN st_timbre ON st_timbre.idTimbre = st_enchere.timbre_idTimbre WHERE st_enchere.$where = :$where;";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$where", $idEnchere);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count != 0) {
            $enchere = $stmt->fetch(PDO::FETCH_ASSOC);
            $enchere = $this->getData($enchere);
            return $enchere;
        } else return false;
    }

    public function getData($enchere)
    {
        // Crée un objet DateTime à partir de la date de fin de l'enchère
        $dateFin = date_create($enchere["dateFin"]);
        // Crée un objet DateTime à partir de la date de début de l'enchère
        $dateDebut = date_create($enchere["dateDebut"]);
        // Crée un objet DateTime pour la date et l'heure actuelles
        $dateNow = date_create(date("Y-m-d h:i"));
        // Calcule la différence entre la date actuelle et la date de fin de l'enchère
        $dateDiff = date_diff($dateNow, $dateFin);
        $enchere['tempsRestant']['d'] = $dateDiff->format("%a");
        $enchere['tempsRestant']['h'] = $dateDiff->format("%H");
        $enchere['tempsRestant']['i'] = $dateDiff->format("%I");
        // On doit vérifier si l'enchere est encore active
        if ($dateDebut > $dateNow) {
            $enchere["status"] = "futur";
            $dateDiff = date_diff($dateDebut, $dateNow);
        } elseif ($dateFin < $dateNow) {
            $enchere["status"] = "archive";
        } else {
            $enchere["status"] = "enCours";
        }
        // On doit aller chercher la condition du timbre
        RequirePage::model('Condition');
        $condition = new Condition;
        $getCondition = $condition->getCondition($enchere['condition_idCondition']);
        $enchere['condition'] = $getCondition['nomCondition'];
        // On doit aller chercher les prix des mises
        RequirePage::model('Mise');
        $mise = new Mise;
        $getMise = $mise->getMaxPriceById($enchere['idEnchere']);
        $enchere['prixMax'] = $getMise['MAX(`prixOffre`)'];
        // Le nb de mises
        $getNbMise = $mise->getNbMise($enchere['idEnchere']);
        $enchere['nbMise'] = $getNbMise['COUNT(`idMise`)'];
        // On doit aller chercher une image de chaque timbre
        $idTimbre = $enchere['timbre_idTimbre'];
        $sql = "SELECT * FROM st_image WHERE timbre_idTimbre = $idTimbre";
        $stmt = $this->query($sql);
        $image = $stmt->fetch();
        if ($image) {
            $enchere['image'] = $image['nomImage'];
        }
        return $enchere;
    }

    public function getIdMembre($id){
        $sql = "SELECT membre_idMembre FROM $this->table where idEnchere = :idEnchere";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":idEnchere", $id);
        $stmt->execute();
        $idMembre = $stmt->fetch();
        return $idMembre['membre_idMembre'];
    }
}
