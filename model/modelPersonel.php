<?php require_once('App.php');
class modelPersonel {
    private $idPers;
    private $nomPers;
    private $prenomPers;
    private $login;
    private $mdp;
    private $idCat;
    private $idSp;
    
    public  function __construct($idPers, $nomPers, $prenomPers, $login, $mdp, $idCat,$idSp) {
        $this->idPers = $idPers;
        $this->nomPers = $nomPers;
        $this->prenomPers = $prenomPers;
        $this->login = $login;
        $this->mdp = $mdp;
        $this->idCat = $idCat;
        $this->idSp = $idSp;
    }
    

// * DEBUT LES FONCTIONS DES MEDECINS *

    public static function addDoctor($nom, $prenom, $login, $mdp,$idSp) {
        $db = App::getDB();
        $sql = "INSERT INTO personnel (nomPers, prenomPers, login, mdp, idcat, idSp) VALUES (?, ?, ?, ?, ?, ?)";
        $params = array($nom, $prenom, $login, $mdp,'1',$idSp);
        $result = $db->execute_query($sql, $params);
        return $result;
    }

    public static function getAllDoctors() {
        $db = App::getDB();
        $sql = "SELECT * FROM personnel JOIN specialite on (personnel.idSp=specialite.idSp)  ";
        $result = $db->execute_query($sql);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getDoctorById($id) {
        $db = App::getDB();
        $sql = "SELECT * FROM personnel JOIN specialite on (personnel.idSp=specialite.idSp) WHERE idPers = ?";
        $params = array($id);
        $result = $db->execute_query($sql, $params);
        return $result->fetch(PDO::FETCH_OBJ);
    }

    public static function getDoctorBySpecialisation($idSp){
        $db = App::getDB();
        $sql = "SELECT * FROM personnel WHERE idSp = ?";
        $params = array($idSp);
        $result = $db->execute_query($sql, $params);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public static function deleteDoctor($id) {
        $db = App::getDB();
        $sql = "DELETE FROM personnel WHERE idPers = ?";
        $params = array($id);
        $result = $db->execute_query($sql, $params);
        return $result;
    }

    public static function editDoctor($id, $nom, $prenom, $login, $mdp,$idSp) {
        $db = App::getDB();
        $sql = "UPDATE personnel SET nomPers=?, prenomPers=?, login=?, mdp=? WHERE idPers=?";
        $params = array($nom, $prenom, $login, $mdp, $id);
        $result = $db->execute_query($sql, $params);
        return $result;
    }

// * FIN DES FONCTIONS DES MEDECINS *

// ** DEBUT DES FONCTIONS DES AGENTS ** 

    public static function addAgent($nom, $prenom, $login, $mdp) {
        $db = App::getDB();
        $sql = "INSERT INTO personnel (nomPers, prenomPers, login, mdp,idcat) VALUES (?, ?, ?, ? ,?)";
        $params = array($nom, $prenom, $login, $mdp,'2');
        $result = $db->execute_query($sql, $params);
        return $result;
    }

    public static function getAllAgents() {
        $db = App::getDB();
        $sql = "SELECT * FROM personnel WHERE idCat = 2  ";
        $result = $db->execute_query($sql);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getAgentById($id) {
        $db = App::getDB();
        $sql = "SELECT * FROM personnel WHERE idCat = 2 AND idPers = ?";
        $params = array($id);
        $result = $db->execute_query($sql, $params);
        return $result->fetch(PDO::FETCH_OBJ);
    }

    public static function deleteAgent($id) {
        $db = App::getDB();
        $sql = "DELETE FROM personnel WHERE idPers = ?";
        $params = array($id);
        $result = $db->execute_query($sql, $params);
        return $result;
    }

    public static function editAgent($id, $nom, $prenom, $login, $mdp) {
        $db = App::getDB();
        $sql = "UPDATE personnel SET nomPers=?, prenomPers=?, login=?, mdp=? WHERE idPers=?";
        $params = array($nom, $prenom, $login, $mdp, $id);
        $result = $db->execute_query($sql, $params);
        return $result;
    }

// ** FIN DES FONCTIONS DES AGENTS **

// *** DEBUT DES FONCTIONS DU DIRECTEUR ***

public static function getAllDirecteur() {
    $db = App::getDB();
    $sql = "SELECT * FROM personnel WHERE idCat = 0  ";
    $result = $db->execute_query($sql);
    return $result->fetchAll(PDO::FETCH_OBJ);
}

public static function getDirecteurById($id) {
    $db = App::getDB();
    $sql = "SELECT * FROM personnel WHERE idCat = 0 AND idPers = ?";
    $params = array($id);
    $result = $db->execute_query($sql, $params);
    return $result->fetch(PDO::FETCH_OBJ);
}

public static function deleteDirecteur($id) {
    $db = App::getDB();
    $sql = "DELETE FROM personnel WHERE idPers = ?";
    $params = array($id);
    $result = $db->execute_query($sql, $params);
    return $result;
}

public static function editDirecteur($id, $nom, $prenom, $login, $mdp) {
    $db = App::getDB();
    $sql = "UPDATE personnel SET nomPers=?, prenomPers=?, login=?, mdp=? WHERE idPers=?";
    $params = array($nom, $prenom, $login, $mdp, $id);
    $result = $db->execute_query($sql, $params);
    return $result;
}
// *** FIN DES FONCTIONS DU DIRECTEUR ***

    public static function login($login,$mdp){
        $db = App::getDB();
        $sql = 'SELECT * FROM personnel WHERE login = ? AND mdp=? ';
        $params = array($login, $mdp);
        $result = $db->execute_query($sql, $params);
        return $result->fetch(PDO::FETCH_OBJ);
    }

}
?>