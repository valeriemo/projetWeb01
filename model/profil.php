<?php
require_once('Crud.php');

class Profil extends Crud{

    public $table = 'st_profil';
    public $primaryKey = 'idProfil';
    public $foreignKey = 'membre_idMembre';


    public $fillable = [
        'idProfil',
        'nom',
        'prenom',
        'ville',
        'motDePresentation',
        'avatar',
        'membre_idMembre'
    ];
}