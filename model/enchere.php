<?php
require_once('Crud.php');

class Enchere extends Crud{

    public $table = 'st_enchere';
    public $primaryKey = 'idEnchere';
    public $foreignKey = 'status_idStatus';
    public $foreignKey2 = 'timbre_idTimbre';
    public $foreignKey3 = 'membre_idMembre';

    public $fillable = [
        'idEnchere',
        'dateDebut',
        'dateFin',
        'prixPlancher',
        'coupDeCoeur',
        'status_idStatus',
        'timbre_idTimbre',
        'membre_idMembre'   
    ];

    public function joinTimbreEnchere(){
        $sql = "SELECT * FROM $this->table JOIN st_timbre ON st_timbre.idTimbre = st_enchere.timbre_idTimbre JOIN st_image ON st_image.timbre_idTimbre = st_timbre.idTimbre ORDER BY st_enchere.dateFin ASC";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
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