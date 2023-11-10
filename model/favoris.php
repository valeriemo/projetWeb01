<?php
//require_once('Crud.php');
RequirePage::core("Crud");

class Favoris extends Crud{

    public $table = 'st_favoris';
    public $primaryKey = ['membre_idMembre', 'enchere_idEnchere'];

    public $fillable = [
        'membre_idMembre',
        'enchere_idEnchere'
    ];

    public function getFavorisById($id){
        $sql = "SELECT enchere_idEnchere FROM $this->table WHERE membre_idMembre = :membre_idMembre AND enchere_idEnchere = :enchere_idEnchere";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":membre_idMembre", $_SESSION['idMembre']);
        $stmt->bindValue(":enchere_idEnchere", $id);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count != 0) return true;
        else return false;
    }
    
    public function deleteFavoris($idMembre, $idEnchere){
        $sql = "DELETE FROM $this->table WHERE enchere_idEnchere = :enchere_idEnchere AND membre_idMembre = :membre_idMembre";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":enchere_idEnchere", $idEnchere);
        $stmt->bindValue(":membre_idMembre", $idMembre);

        if ($stmt->execute()) {
            return true;
        }
    }
}