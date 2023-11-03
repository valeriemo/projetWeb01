<?php
require_once('Crud.php');

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


}