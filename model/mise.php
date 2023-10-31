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
}