<?php
   include('../../model/ModelPersonel.php');
   if(!empty($_POST["specilizationid"])){
      $idSp=$_POST['specilizationid'];
      $doctors=ModelPersonel::getDoctorBySpecialisation($idSp);?>
      <option selected="selected">sélectionner médecin </option>
      <?php
      foreach($doctors as $row){ 
         ?>
         <option value="<?php echo $row->idPers; ?>"><?php echo $row->nomPers. " " .$row->prenomPers  ;?></option>
         <?php
      }
   }
?>

