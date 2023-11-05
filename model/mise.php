<?php
require_once('Crud.php');

class Mise extends Crud{

    public $table = 'st_mise';
    public $primaryKey = 'idMise';
    public $foreignKey = 'enchere_idEnchere';
    public $foreignKey2 = 'membre_idMembre';

    public $fillable = [
        'idMise',
        'enchere_idEnchere',
        'membre_idMembre',
        'prixOffre',
        'dateHeure'
    ];

    public function getMaxPriceById($idEnchere)
    {
        $sql = "SELECT MAX(`prixOffre`) FROM $this->table where `enchere_idEnchere` = :$this->foreignKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->foreignKey", $idEnchere);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getNbMise($idEnchere){
        $sql = "SELECT COUNT(`idMise`) FROM $this->table where `enchere_idEnchere` = :$this->foreignKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->foreignKey", $idEnchere);
        $stmt->execute();
        return $stmt->fetch();
    }
}