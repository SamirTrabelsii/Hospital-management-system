<?php 
require_once 'model/ModelTimeSlotBlocked.php';
require_once 'model/ModelClient.php';
require_once 'model/ModelPersonel.php';
require_once 'model/ModelRdv.php';
require_once 'model/ModelMotif.php';
class ControllerCreneaux{
    //récupère les rendez-vous du médecin connecté et les blocs de temps qui sont déjà bloqués pour afficher un calendrier dans la vue CalendarDoctor.php.
  public static function afficherCalendar(){
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    $rdvsdoc=ModelRdv::getRdvByDoctor($_SESSION['idPers']);
    $taches=ModelTimeSlotBlocked::getAllTimeSlotBlockedByIdPers($_SESSION['idPers']);
    require ('vue/doctor/CalendarDoctor.php');
  }
  //affiche le formulaire pour que les médecins puissent bloquer les créneaux horaires pour leur absence.
  public static function bloquerCreneaux(){
    require ('vue/doctor/BloquerCreneaux.php');
  }
  //récupère les créneaux horaires que les médecins ont bloqués pour leur absence et les ajoute à la base de données à l'aide de la méthode addTimeSlotBlocked() du modèle ModelTimeSlotBlocked. Elle utilise également la session pour récupérer l'ID du médecin connecté.
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
}
?>