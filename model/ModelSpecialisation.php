<?php
require_once 'app.php';

class ModelSpecialisation {
    private $idSp;
    private $libelleSp;
    
    public function __construct($idSp, $libelleSp){
        $this->idSp = $idSp;
        $this->libelleSp = $libelleSp;
    }
    public static function getAll() {
        $db = App::getDB();
        $sql = "SELECT * FROM specialite";
        $result = $db->execute_query($sql);
        if(!$result) {
            $erreur=$conn->errorInfo();
            echo "Lecture impossible, code", $conn->errorCode(),$erreur[2];
        }
        else{           
            return $result->fetchAll(PDO::FETCH_OBJ);
        }

    }

    public static function add($libelleSp) {
        $db = App::getDB();
        $sql = "INSERT INTO specialite (libelleSp) VALUES (?)";
        $params = array($libelleSp);
        $result = $db->execute_query($sql, $params);
        return $result;
    }

    public static function delete($idSp) {
        $db = App::getDB();
        $sql = "DELETE FROM specialite WHERE idSp = ?";
        $params = array($idSp);
        $result = $db->execute_query($sql, $params);
        return $result;
    }

    public static function edit($idSp, $libelleSp) {
        $db = App::getDB();
        $sql = "UPDATE specialite SET libelleSp = ? WHERE idSp = ?";
        $params = array($libelleSp, $idSp);
        $result = $db->execute_query($sql, $params);
        return $result;
    }
}
