<?php
//require_once('Crud.php');
RequirePage::core("Crud");

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

        /**
     * Méthode qui va chercher le nom des l'images d'un timbre
     */
    public function deleteImage($id){
        $sql = "DELETE FROM $this->table WHERE `timbre_idTimbre` = :timbre_idTimbre";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":timbre_idTimbre", $id);
        if ($stmt->execute()) {
            return true;
        }
    }

}