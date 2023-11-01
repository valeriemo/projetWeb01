<?php
require_once('Crud.php');

class Image extends Crud{

    public $table = 'st_image';
    public $primaryKey = 'idImage';
    public $foreignKey = 'timbre_idTimbre';

    public $fillable = [
        'idImage',
        'timbre_idTimbre',
        'nomImage'
    ];
}