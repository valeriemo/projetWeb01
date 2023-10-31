<?php
require_once('Crud.php');

class Status extends Crud{

    public $table = 'st_status';
    public $primaryKey = 'idStatus';


    public $fillable = [
        'idStatus',
        'status'
    ];
}