<?php
//require_once('Crud.php');
RequirePage::core("Crud");

class Membre extends Crud{

    public $table = 'st_membre';
    public $primaryKey = 'idMembre';
    public $foreignKey = 'profil_idProfil';
    public $foreignKey2 = 'privilege_idPrivilege';

    public $fillable = [
        'idMembre',
        'courriel',
        'password',
        'dateInscription',
        'profil_idProfil',
        'privilege_idPrivilege',
        'nom',
        'prenom',
    ];

    
    /**
     * Méthode qui permet de hasher le mot de passe
     * 
     * @param string $password
     * @return string
     */
    public function checkUser($courriel, $password){ 
        $sql = "SELECT * FROM $this->table WHERE courriel = :courriel";
        $query = $this->prepare($sql);
        $query->bindValue(":courriel", $courriel);
        $query->execute();
        $count = $query->rowCount();
        if ($count === 1) {
            $membre = $query->fetch();
            if (password_verify($password, $membre['password'])) {
                session_regenerate_id();
                $_SESSION['idMembre'] = $membre['idMembre'];
                $_SESSION['courriel'] = $membre['courriel'];
                $_SESSION['privilege'] = $membre['privilege_idPrivilege'];
                $_SESSION['fingerPrint'] = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateMembre($primaryKey, $fieldName, $fieldValue)
    {
        $sql = "UPDATE $this->table SET $fieldName = :fieldValue WHERE $this->primaryKey = :idMembre";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':idMembre', $primaryKey);
        $stmt->bindValue(':fieldValue', $fieldValue);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return $stmt->errorInfo();
        }
    }
}