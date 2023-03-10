<?php 
require('model/ModelTimeSlotBlocked.php');
require_once 'model/ModelClient.php';
require_once 'model/ModelPersonel.php';
require_once 'model/ModelRdv.php';
require_once 'model/ModelMotif.php';
class ControllerCreneaux{
    public static function bloquerCreneaux(){
        require ('vue/doctor/BloquerCreneaux.php');
    }
    public static function bloquerCreneauxProcess(){
        session_start();       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          // Retrieve the number of appointment times from the form
          $nbCreneaux = $_POST['nb_creneaux'];
        
          // Process each appointment time
          for ($i = 0; $i < $nbCreneaux; $i++) {
            // Retrieve the date, time, and reason for absence from the form
            $date = $_POST['date'][$i];
            $heure = $_POST['heure'][$i];
            $raison = $_POST['raison'][$i];
            $datetime = $date . ' ' . $heure . ':00';
            ModelTimeSlotBlocked::addTimeSlotBlocked($datetime,$raison,$_SESSION['idPers']);
          }
        }
        
          require ('vue/doctor/BloquerCreneaux.php');
    }
//     public static function getRDVbyDoctor(){
//       $nss=$_POST["nss"];
//       $idPers=$_GET["idPers"];
//       $client =ModelClient::getClient($nss);
//       $rdvs=ModelRdv::getRdvByDoctor($idPers);
//       require ('vue/agent/BloquerCreneaux.php');
//  }  


}


?>