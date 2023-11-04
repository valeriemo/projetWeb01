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

    /**
     * Méthode qui va chercher le nom des l'images d'un timbre
     */
    public function getImageById($id){
        $sql = "SELECT `nomImage` FROM $this->table WHERE `timbre_idTimbre` = $id";
        $stmt = $this->query($sql);
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

}