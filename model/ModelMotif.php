<?php
require_once('App.php');

class ModelMotif {
    private $libelleMo;
    private $prixMo;
    private $libelleCo;
    private $libellePi;

    // * LES FONCTIONS DES MOTIFS *
    
    public static function getAllMotifs() {
        $db = App::getDB();//Récupérer une instance de la base de données.
        $sql = "SELECT * FROM motif
        JOIN piecemotif ON piecemotif.idMo = motif.idMo
        JOIN piece ON piecemotif.idPi = piece.idPi
        JOIN consignemotif ON consignemotif.idMo = motif.idMo 
        JOIN consigne ON consignemotif.idCo = consigne.idCo ;";
        $result = $db->execute_query($sql);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getMotifById($idMo) {
        $db = App::getDB();//Récupérer une instance de la base de données.
        $sql = "SELECT * FROM motif
        JOIN piecemotif ON piecemotif.idMo = motif.idMo
        JOIN piece ON piecemotif.idPi = piece.idPi
        JOIN consignemotif ON consignemotif.idMo = motif.idMo 
        JOIN consigne ON consignemotif.idCo = consigne.idCo
        WHERE motif.idMo = ? ;";
        $params = array($idMo);
        $result = $db->execute_query($sql, $params);
        return $result->fetch(PDO::FETCH_OBJ);
    }

    public static function addM($libelleMo, $prixMo, $libellePi, $libelleCo) {
        $db = App::getDB();//Récupérer une instance de la base de données.
        $sql = "INSERT INTO motif (libelleMo, prixMo) VALUES (?,?);
                SET @idMo = LAST_INSERT_ID();
                INSERT INTO piece (libellePi) VALUES (?);
                INSERT INTO consigne (libelleCo) VALUES (?);
                INSERT INTO consignemotif (idMo,idCo) VALUES(@idMo,@idMo);
                INSERT INTO piecemotif (idMo,idPi) VALUES (@idMo,@idMo)";
        $params = array($libelleMo, $prixMo,$libellePi, $libelleCo );
        $resultat = $db->execute_query($sql, $params);
        return $resultat;
    }

    public static function editM($idMo, $libelleMo, $prixMo, $libellePi, $libelleCo) {
        $db = App::getDB();//Récupérer une instance de la base de données.
        $sql = "UPDATE motif SET libelleMo=?, prixMo=? WHERE motif.idMo=?;";
        $params = array($libelleMo, $prixMo,$idMo);
        $db->execute_query($sql, $params);

        $sql = "UPDATE piece SET libellePi=? WHERE idPi=?;";
        $params = array($libellePi, $idMo);
        $db->execute_query($sql, $params);

        $sql = "UPDATE consigne SET libelleCo=? WHERE idCo=?";
        $params = array($libelleCo, $idMo);
        $db->execute_query($sql, $params);

        return true ;
    }

    public static function deleteM($idMo) {
        $db = App::getDB();//Récupérer une instance de la base de données.
        $sql = "DELETE motif, piecemotif, piece, consignemotif, consigne FROM motif
                JOIN piecemotif ON piecemotif.idMo = motif.idMo
                JOIN piece ON piecemotif.idPi = piece.idPi
                JOIN consignemotif ON consignemotif.idMo = motif.idMo 
                JOIN consigne ON consignemotif.idCo = consigne.idCo
                WHERE motif.idMo =? ;";
        $params = array($idMo);
        return $db->execute_query($sql, $params);
    }

}
?>