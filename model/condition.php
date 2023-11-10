<?php
//require_once('Crud.php');
RequirePage::core("Crud");

class Condition extends Crud
{

    public $table = 'st_condition';
    public $primaryKey = 'idCondition';

    public $fillable = [
        'idCondition',
        'nomCondition'
    ];

    public function getCondition($idCondition)
    {
        $sql = "SELECT `nomCondition` From $this->table where `idCondition`= $idCondition";
        $stmt = $this->query($sql);
        return $stmt->fetch();
    }
    public function getAllCondition()
    {
        $sql = "SELECT `nomCondition` From $this->table";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }
}
