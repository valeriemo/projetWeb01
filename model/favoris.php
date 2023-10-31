<?php
require_once('Crud.php');

class Favoris extends Crud{

    public $table = 'st_favoris';
    public $primaryKey = ['membre_idMembre', 'enchere_idEnchere'];

    public $fillable = [
        'membre_idMembre',
        'enchere_idEnchere'
    ];
}