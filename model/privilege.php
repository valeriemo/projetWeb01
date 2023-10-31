<?php
require_once('Crud.php');

class Privilege extends Crud{

    public $table = 'st_privilege';
    public $primaryKey = 'idPrivilege';

    public $fillable = [
        'idPrivilege',
        'privilege'
    ];
}