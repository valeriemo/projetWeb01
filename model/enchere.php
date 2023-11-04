<?php
require_once('Crud.php');

class Enchere extends Crud{

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

    public function getTimbreIfEnchere($idMembre){
        $sql = "SELECT * FROM st_timbre RIGHT JOIN st_enchere ON st_timbre.idTimbre = st_enchere.timbre_idTimbre WHERE st_timbre.membre_idMembre = $idMembre ORDER BY st_enchere.dateFin ASC;";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    public function joinTimbreEnchere(){
        $sql = "SELECT * FROM $this->table JOIN st_timbre ON st_timbre.idTimbre = st_enchere.timbre_idTimbre ORDER BY st_enchere.dateFin ASC";
        $stmt = $this->query($sql);
        $encheres = $stmt->fetchAll();
        // On doit aller chercher une image de chaque timbre
        foreach ($encheres as &$enchere) {
            $idTimbre = $enchere['timbre_idTimbre'];
            $sql = "SELECT * FROM st_image WHERE timbre_idTimbre = $idTimbre";
            $stmt = $this->query($sql);
            $image = $stmt->fetch();
            if ($image) {
                $enchere['image'] = $image['nomImage'];
            }
        }
        return $encheres;

    }



    public function joinTimbreEnchereById($idEnchere, $where){
        $sql = "SELECT * FROM $this->table INNER JOIN st_timbre ON st_timbre.idTimbre = st_enchere.timbre_idTimbre WHERE st_enchere.$where = :$where;";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$where", $idEnchere);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count != 0) return $stmt->fetchAll();
        else return false;  
    }

}