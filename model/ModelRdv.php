<?php 
require_once('App.php');
class ModelRdv {
    private $idRDV;
    private $dateRDV;
    private $etatRDV;
    private $nss;
    private $idPers;
    private $idMo;
    
    public function __construct($idRDV, $dateRDV, $etatRDV, $nss, $idPers, $idMo) {
        $this->idRDV = $idRDV;
        $this->dateRDV = $dateRDV;
        $this->etatRDV = $etatRDV;
        $this->nss = $nss;
        $this->idPers = $idPers;
        $this->idMo = $idMo;
    }

    public static function addRdv($dateRDV, $etatRDV, $nss, $idPers, $idMo) {
        $sql = "INSERT INTO rdv (dateRDV, etatRDV, nss, idPers,idMo) VALUES (?,?, ?, ?,?)";
        $params = array($dateRDV, $etatRDV, $nss, $idPers, $idMo);
        $db = App::getDB();
        $result = $db->execute_query($sql, $params);
    }
    
    public static function deleteRdv() {
        $sql = "DELETE FROM rdv WHERE idRDV = ?";
        $params = array($this->idRDV);
        $db = App::getDB();
        $result = $db->execute_query($sql, $params);
    }
    
    public static function getRdv($idRDV) {
        $sql = "SELECT * FROM rdv join motif on rdv.idMO=motif.idMo WHERE idRDV = ?";
        $params = array($idRDV);
        $db = App::getDB();
        $result = $db->execute_query($sql, $params);
        return $result->fetch(PDO::FETCH_OBJ);
    }
    
    public static function getAllRdv() {
        $sql = "SELECT * FROM rdv join motif on rdv.idMO=motif.idMo";
        $db = App::getDB();
        $result = $db->execute_query($sql);
        $rdvList = array();
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $rdvList[] = new ModelRdv($row->idRDV, $row->dateRDV, $row->etatRDV, $row->nss, $row->idPers);
        }
        return $rdvList;
    }
    
    public static function editRdv($idRDV) {
        $sql = "UPDATE rdv SET  etatRDV = ? WHERE idRDV = ?";
        $params = array("payée",$idRDV);
        $db = App::getDB();
        $result = $db->execute_query($sql, $params);
    }
    public static function getRdvByClient($nss){
        $sql = "SELECT * FROM rdv join personnel on rdv.idPers=personnel.idPers JOIN specialite on personnel.idSp=specialite.idSp join motif on rdv.idMo=motif.idMo  WHERE nss = ?";
        $db = App::getDB();
        $params = [$nss];
        $result = $db->execute_query($sql, $params);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }
    public static function getRdvByDoctor($idPers){
        $sql = "SELECT * FROM rdv join personnel on rdv.idPers=personnel.idPers JOIN specialite on personnel.idSp=specialite.idSp join motif on rdv.idMo=motif.idMo  WHERE rdv.idPers = ?";
        $db = App::getDB();
        $params = [$idPers];
        $result = $db->execute_query($sql, $params);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }   
}
