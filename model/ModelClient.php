<?php 
require_once('App.php');
class ModelClient {
    private $nss;
    private $nom;
    private $prenom;
    private $adresse;
    private $num_tel;
    private $date_naissance;
    private $depart_naissance;
    private $solde;

    public function __construct($nss, $nom, $prenom, $adresse, $num_tel, $date_naissance, $depart_naissance, $solde) {
        $this->nss = $nss;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->num_tel = $num_tel;
        $this->date_naissance = $date_naissance;
        $this->depart_naissance = $depart_naissance;
        $this->solde = $solde;
    }

    public static function AddClient($nss, $nom, $prenom, $adresse, $num_tel, $date_naissance, $depart_naissance,$solde) {
        $db = App::getDB();
        $sql = "INSERT INTO client (nss, nomCl, prenomCl, adresse, numTel, dateNais, departementNais, solde) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $params = array($nss, $nom, $prenom, $adresse, $num_tel, $date_naissance, $depart_naissance, $solde);
        return $db->execute_query($sql, $params);
    }

    public static function deleteClient($nss) {
        $db = App::getDB();
        $sql = "DELETE FROM client WHERE nss = ?";
        $params = [$nss];
        return $db->execute_query($sql, $params);
    }

    public static function getClient($nss) {
        $db = App::getDB();
        $sql = "SELECT * FROM client WHERE nss = ?";
        $params = [$nss];
        $result = $db->execute_query($sql, $params);
        return $result->fetch(PDO::FETCH_OBJ);
    }

    public static function getAllClients() {
        $db = App::getDB();
        $sql = "SELECT * FROM client";
        $result = $db->execute_query($sql);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public static function editClient($nom, $prenom, $adresse, $num_tel, $date_naissance, $depart_naissance, $nss) {
        $db = App::getDB();
        $sql = "UPDATE client SET nomCl = ?, prenomCl = ?, adresse = ?, numTel = ?, dateNais = ?, departementNais = ? WHERE nss = ?";
        $params = [$nom, $prenom, $adresse, $num_tel, $date_naissance, $depart_naissance, $nss];
        return $db->execute_query($sql, $params);
    }
    public static function addSolde($nss,$solde) {
        $db = App::getDB();
        $sql = "UPDATE client SET solde = solde + ? WHERE nss = ?";
        $params = [$solde, $nss];
        return $db->execute_query($sql, $params);
    }
    public static function diminueSolde($nss,$solde) {
        $db = App::getDB();
        $sql = "UPDATE client SET solde = solde - ? WHERE nss = ?";
        $params = [$solde, $nss];
        return $db->execute_query($sql, $params);
    }

    // cette fonction determine le nss du client en entrant son nom et son date de naissance ( page consulter patient )
    
    public static function NSSequivalent($nom, $date_naissance) {
        $db = App::getDB();
        $sql = "SELECT nss FROM client WHERE nomCl = ? AND dateNais = ?";
        $params = [$nom, $date_naissance];
        $result = $db->execute_query($sql, $params);
        $nss = $result->fetch(PDO::FETCH_OBJ)->nss;
        return $nss;
    }
}
?>