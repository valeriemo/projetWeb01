<?php
//require_once('Crud.php');
RequirePage::core("Crud");

class Privilege extends Crud{

    public $table = 'st_privilege';
    public $primaryKey = 'idPrivilege';

    public $fillable = [
        'idPrivilege',
        'privilege'
    ];
}