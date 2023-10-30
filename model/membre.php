<?php
require_once('Crud.php');

class Membre extends Crud{

    public $table = 'st_membre';
    public $primaryKey = 'idMembre';
    public $foreignKey = 'profil_idProfil';
    public $foreignKey2 = 'privilege_idPrivilege';

    public $fillable = [
        'idMembre',
        'username',
        'courriel',
        'password',
        'dateInscription',
        'profil_idProfil',
        'privilege_idPrivilege'
    ];
}