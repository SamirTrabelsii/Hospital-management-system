<?php
require_once('App.php');

class ModelTimeSlotBlocked {
    private $idTa;
    private $dateTa;
    private $libelleTa;
    private $idPers;

    public function __construct($idTa, $dateTa, $libelleTa, $idPers) {
        $this->idTa = $idTa;
        $this->dateTa = $dateTa;
        $this->libelleTa = $libelleTa;
        $this->idPers = $idPers;
    }

    public static function getAllTimeSlotBlockedByIdPers($idPers) {
        $sql = "SELECT * FROM tacheadmin WHERE idPers = ?";
        $db = App::getDB();
        $params = array($idPers);
        $result = $db->execute_query($sql, $params);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public static function addTimeSlotBlocked( $dateTa, $libelleTa, $idPers) {
        $sql = "INSERT INTO tacheadmin (dateTa, libelleTa, idPers) VALUES (?, ?, ?)";
        $params = array( $dateTa, $libelleTa, $idPers);
        $db = App::getDB();
        $db->execute_query($sql, $params);
    }

    public function deleteTimeSlotBlocked() {
        $sql = "DELETE FROM tacheadmin WHERE idTa = ?";
        $params = array($this->idTa);
        App::getDB()->execute_query($sql, $params);
    }

    public function editTimeSlotBlocked() {
        $sql = "UPDATE tacheadmin SET dateTa = ?, libelleTa = ?, idPers = ? WHERE idTa = ?";
        $params = array($this->dateTa, $this->libelleTa, $this->idPers, $this->idTa);
        App::getDB()->execute_query($sql, $params);
    }
        
    
}

?>