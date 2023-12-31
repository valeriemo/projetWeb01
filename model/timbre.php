<?php
//require_once('Crud.php');
RequirePage::core("Crud");

class Timbre extends Crud{

    public $table = 'st_timbre';
    public $primaryKey = 'idTimbre';
    public $foreignKey = 'condition_idCondition';
    public $foreignKey2 = 'membre_idMembre';

    public $fillable = [
        'idTimbre',
        'nomTimbre',
        'anneeEmission',
        'couleurs',
        'paysOrigine',
        'tirage',
        'dimension',
        'certification',
        'condition_idCondition',
        'membre_idMembre'
    ];

    public function getTimbreNotInEnchere($idMembre){
        $sql = "SELECT * FROM $this->table LEFT JOIN st_enchere ON st_timbre.idTimbre = st_enchere.timbre_idTimbre where st_timbre.membre_idMembre = $idMembre
        ";
        $query = $this->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

}