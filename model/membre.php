<?php
require_once('Crud.php');

class Membre extends Crud{

    public $table = 'st_membre';
    public $primaryKey = 'idMembre';
    public $foreignKey = 'profil_idProfil';
    public $foreignKey2 = 'privilege_idPrivilege';

    public $fillable = [
        'idMembre',
        'username',
        'courriel',
        'password',
        'dateInscription',
        'profil_idProfil',
        'privilege_idPrivilege'
    ];

    
    /**
     * Méthode qui permet de hasher le mot de passe
     * 
     * @param string $password
     * @return string
     */
    public function checkUser($username, $password){ 
        
        $sql = "SELECT * FROM $this->table WHERE username = :$username";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$username", $username);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count === 1) {
            $membre = $stmt->fetch();
            if (password_verify($password, $membre['password'])) {
                session_regenerate_id();
                $_SESSION['idMembre'] = $membre['idMembre'];
                $_SESSION['username'] = $membre['username'];
                $_SESSION['privilege'] = $membre['privilege_idPrivilege'];
                $_SESSION['fingerPrint'] = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
                return true;
            } else {
                echo 'no';
            }
        } else {
            return false;
        }
    }
}