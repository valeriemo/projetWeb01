<?php
require_once('Crud.php');

class Condition extends Crud{

    public $table = 'st_condition';
    public $primaryKey = 'idCondition';

    public $fillable = [
        'idCondition',
        'nomCondition'
    ];
}