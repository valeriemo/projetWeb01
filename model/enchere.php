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
}