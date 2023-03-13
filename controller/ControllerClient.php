<?php 
session_start();
require_once 'model/ModelClient.php';
require_once 'model/ModelPersonel.php';
require_once 'model/ModelRdv.php';
require_once 'model/ModelTimeSlotBlocked.php';
require_once 'model/ModelMotif.php';

class ControllerClient{
    public static function SaisirClient(){
        require ('vue/agent/ajouter-patient.php');
    }
     public static function editPatient(){
        $nss=$_GET['NSS'];
        $client=ModelClient::getClient($nss);
        require ('vue/agent/editPatient.php');
    }
    public static function SaisirNSSClient(){
        require ('vue/agent/SaisirNSSClient.php');
    }
    public static function getDoctor(){
        if(!empty($_POST["specilizationid"])){
            $idSp=$_POST['specilizationid'];
            $doctors=ModelPersonel::getDoctorBySpecialisation($idSp);?>
            <option selected="selected">Sélectionner médecin </option>
            <?php
            foreach($doctors as $row)
                {?>
             <option value="<?php echo $row['id']; ?>"><?php echo ($row['doctorName']); ?></option>
             <?php
           }
        }
    }
    public static function consultationPatient(){
        $nss=$_POST["nss"];
        $client =ModelClient::getClient($nss);
        $rdvs=ModelRdv::getRdvByClient($nss);
        require ('vue/agent/ConsultationPatient.php');
   }  



   public static function payement(){
    $nss=$_GET["NSS"];
    $idRDV=$_GET["idRDV"];
    $client =ModelClient::getClient($nss);
    $rdv=ModelRdv::getRdv($idRDV);
    require ('vue/agent/payement.php');

   }
   public static function payementProcess(){

    $idRDV=$_GET["idRDV"];
    $nss=$_GET["NSS"];
    $client =ModelClient::getClient($nss);
    $rdv=ModelRdv::getRdv($idRDV);
    $solde=$client->solde;
    $prixMo=$rdv->prixMo;
    if($solde > $prixMo){
        ModelRdv::editRdv($idRDV);
        ModelClient::diminueSolde($nss,$prixMo);
        echo "<script>alert('Payement fait avec succés');</script>";
        $client =ModelClient::getClient($nss);
    $rdvs=ModelRdv::getRdvByClient($nss);
    require ('vue/agent/ConsultationPatient.php');
    }
    else{
        echo "<script>alert('Votre solde est insuffisant');</script>";
        $client =ModelClient::getClient($nss);
        $rdv=ModelRdv::getRdv($idRDV);
        require ('vue/agent/payement.php');
    }

   }

   public static function addRdv(){
    $nss=$_GET["NSS"];
    $motifs=ModelMotif::getAllMotifs();
    require ('vue/agent/PrendreRdv.php');
   }
   // DEBUT ESSAI CHATGPT

    public static function verifyRdv(){
        // Get the date and time values from the form
        $nss=$_GET["NSS"];
        $date = $_POST['appointmentdate'];
        $time = $_POST['appttime'];
        $idPers=$_POST['doctor'];
        $idSp=$_POST['Doctorspecialization'];
        $idMo=$_POST['Motif'];

        // Combine the date and time values into a single datetime value
        $datetime = $date . ' ' . $time . ':00';
        $tacheAdmin=ModelTimeSlotBlocked::getAllTimeSlotBlockedByIdPers($idPers);
        $rdvdoc=ModelRdv::getRdvByDoctor($idPers);

        $verif_ta = true;
        if ($tacheAdmin) {
            // Check if there are any time slots blocked for the given datetime
            reset($tacheAdmin); // set the pointer to the first element
            while ($row = current($tacheAdmin)) {
                if ($row->dateTa == $datetime) {
                    $_SESSION["err"] = 'médecin non disponible en raison de ' . $row->libelleTa . " | Merci de prendre un RDV dans un autre temps ";
                    $motifs = ModelMotif::getAllMotifs();
                    require('vue/agent/PrendreRdv.php');
                    $verif_ta = false;
                    break; // exit the loop if the condition is not met
                }
                next($tacheAdmin); // move the pointer to the next element
            }
        }
        if ($verif_ta) {
            // Check if there are any appointments for the given datetime
            $verif_rdv = true;
            if ($rdvdoc) {
                reset($rdvdoc); // set the pointer to the first element
                while ($row = current($rdvdoc)) {
                    if ($row->dateRDV == $datetime) {
                        $_SESSION["err"] = 'médecin non disponible en raison d"un autre RDV | Merci de prendre un RDV dans un autre temps ';
                        $motifs = ModelMotif::getAllMotifs();
                        require('vue/agent/PrendreRdv.php');
                        $verif_rdv = false;
                        break; // exit the loop if the condition is not met
                    }
                    next($rdvdoc); // move the pointer to the next element
                }
            }
            if ($verif_rdv) {
                // Add the appointment to the database
                $nss = $_GET["NSS"];
                $client = ModelClient::getClient($nss);
                $rdv = ModelRdv::addRdv($datetime, "En attente", $nss, $idPers, $idMo);
                $rdvs = ModelRdv::getRdvByClient($nss);
                require('vue/agent/ConsultationPatient.php');
            }
        }
    }
// FIN ESSAI CHATGPT
//    public static function verifyRdvDoc(){
//     // Get the date and time values from the form
//     $nss=$_GET["NSS"];
//     $date = $_POST['appointmentdate'];
//     $time = $_POST['appttime'];
//     $idPers=$_POST['doctor'];
//     $idSp=$_POST['Doctorspecialization'];
//     $idMo=$_POST['Motif'];

//     // Combine the date and time values into a single datetime value
//     $datetime = $date . ' ' . $time . ':00';
//     $rdvdoc=ModelRdv::getRdvByDoctor($idPers);
    
//     if ($rdvdoc) {
//      $verif_rdv = true;
//      reset($rdvdoc); // set the pointer to the first element
//      while ($row = current($rdvdoc)) {
//          if ($row->dateRDV == $datetime) {
//              $_SESSION["err"] = "Médecin dans un autre rdv | Merci de prendre un RDV dans un autre temps ";
//              $motifs = ModelMotif::getAllMotifs();
//              require('vue/agent/PrendreRdv.php');
//              $verif_rdv = false;
//              break; // exit the loop if the condition is not met
//          }
//          next($rdvdoc); // move the pointer to the next element
//      }
//      if ($verif_rdv) {
//          $nss = $_GET["NSS"];
//          $client = ModelClient::getClient($nss);
//          $rdv = ModelRdv::addRdv($datetime, "En attente", $nss, $idPers, $idMo);
//          $rdvs = ModelRdv::getRdvByClient($nss);
//          require('vue/agent/ConsultationPatient.php');
//      }
//  } else {
//      $nss = $_GET["NSS"];
//      $client = ModelClient::getClient($nss);
//      $rdv = ModelRdv::addRdv($datetime, "En attente", $nss, $idPers, $idMo);
//      $rdvs = ModelRdv::getRdvByClient($nss);
//      require('vue/agent/ConsultationPatient.php');
//  }
//  }

//    public static function verifyRdv(){
//        // Get the date and time values from the form
//        $nss=$_GET["NSS"];
//        $date = $_POST['appointmentdate'];
//        $time = $_POST['appttime'];
//        $idPers=$_POST['doctor'];
//        $idSp=$_POST['Doctorspecialization'];
//        $idMo=$_POST['Motif'];

//        // Combine the date and time values into a single datetime value
//        $datetime = $date . ' ' . $time . ':00';
//        $tacheAdmin=ModelTimeSlotBlocked::getAllTimeSlotBlockedByIdPers($idPers);
//        $rdvdoc=ModelRdv::getRdvByDoctor($idPers);

       
//         if ($tacheAdmin) {
//             $verif_ta = true;
//             reset($tacheAdmin); // set the pointer to the first element
//             while ($row = current($tacheAdmin)) {
//                 if ($row->dateTa == $datetime) {
//                     $_SESSION["err"] = 'médecin non disponible en raison de ' . $row->libelleTa . " | Merci de prendre un RDV dans un autre temps ";
//                     $motifs = ModelMotif::getAllMotifs();
//                     require('vue/agent/PrendreRdv.php');
//                     $verif_ta = false;
//                     break; // exit the loop if the condition is not met
//                 }
//                 next($tacheAdmin); // move the pointer to the next element
//             }
//             if ($verif_ta) {
//                 $nss = $_GET["NSS"];
//                 $client = ModelClient::getClient($nss);
//                 $rdv = ModelRdv::addRdv($datetime, "En attente", $nss, $idPers, $idMo);
//                 $rdvs = ModelRdv::getRdvByClient($nss);
//                 require('vue/agent/ConsultationPatient.php');
//             }
//         } else {
//             $nss = $_GET["NSS"];
//             $client = ModelClient::getClient($nss);
//             $rdv = ModelRdv::addRdv($datetime, "En attente", $nss, $idPers, $idMo);
//             $rdvs = ModelRdv::getRdvByClient($nss);
//             require('vue/agent/ConsultationPatient.php');
//         }
//     }
    public static function editProcess($code=null){
        if(isset($_POST['submit']))
        {
            $nss=$_POST['nss'];
            $first_name=$_POST['first_name'];
            $second_name=$_POST['second_name'];
            $address=$_POST['address'];
            $num_tel=$_POST['num_tel'];
            $date_de_naissance=$_POST['date_de_naissance'];
            if(isset($_POST['dep_naissance'])){
                if($_POST['dep_naissance']!=99){
                    $naissance=$_POST['dep_naissance'];
                }else{
                    $naissance=$_POST['pays_naissance'];
                }
            }else{
                $naissance=$_POST['pays_naissance'];
            }
            $query=ModelClient::editClient($first_name,$second_name,$address,$num_tel,$date_de_naissance,$naissance,$nss);
            if($query)
            {
                $nss=$_POST['nss'];
                $client =ModelClient::getClient($nss);
                $rdvs=ModelRdv::getRdvByClient($nss);
                require ('vue/agent/ConsultationPatient.php');
            }
        }
    }
    public static function addProcess($code=null){
        if(isset($_POST['submit']))
        {
            $nss=$_POST['nss'];
            $first_name=$_POST['first_name'];
            $second_name=$_POST['second_name'];
            $num_tel=$_POST['num_tel'];
            $date_de_naissance=$_POST['date_de_naissance'];
            $address=$_POST['address'];
            $solde=$_POST['solde'];
            if(isset($_POST['dep_naissance'])){
                if($_POST['dep_naissance']!=99){
                    $depart_naissance=$_POST['dep_naissance'];
                }else{
                    $depart_naissance=$_POST['pays_naissance'];
                }
            }
            else{
                $depart_naissance=$_POST['pays_naissance'];

            }
            
            $query=ModelClient::addClient($nss,$first_name,$second_name,$address,$num_tel,$date_de_naissance,$depart_naissance,$solde);
            if($query)
            {
                echo "<script>alert('Patient enregistré avec succés');</script>";
                require ('vue/agent/index.php');
            }
        }
    }
    public static function addSolde(){
            $nss=$_GET["NSS"];
            $solde=$_POST["solde"];
            ModelClient::addSolde($nss,$solde);
            $client =ModelClient::getClient($nss);
            $rdvs=ModelRdv::getRdvByClient($nss);
            require ('vue/agent/ConsultationPatient.php');

            
        
    }
}



?>