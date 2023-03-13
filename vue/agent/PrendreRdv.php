<?php

if (isset($_SESSION['err'])) {
    // Display an alert message using JavaScript
    echo "<script>alert('" . $_SESSION['err'] . "');</script>";
    
    // Unset the session variable
    unset($_SESSION['err']);
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Prendre un RDV</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
        <script>
			function getdoctor(val) {
				$.ajax({
					type: "POST",
					url: "vue/agent/get_doctor.php",
					data:'specilizationid='+val,
					success: function(data){
						$("#doctor").html(data);
					}
				});
			}
		</script>

	</head>
	<body>
		<div id="app">		
		<?php include('include/sidebarAgent.php');?>
			<div class="app-content">
			<?php include('include/header.php');?>  
                <div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Ajouter rdv</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Directeur</span>
									</li>
									<li class="active">
										<span>Ajouter RDV</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Enregistrer un RDV</h5>
												</div>
												<div class="panel-body">
													<form action="index.php?controller=Client&action=verifyRdv&NSS=<?php echo $nss ?>" role="form" name="adddoc" method="post" onSubmit="return valid();">
                                                    	<div class="form-group">
															<label for="DoctorSpecialization">
																Spécialité 
                                                               <?php require_once ('model/ModelSpecialisation.php');
                                                                $specialisation=ModelSpecialisation::getAll(); 
                                                                ?>
		    												</label>
															<select name="Doctorspecialization" class="form-control" onChange="getdoctor(this.value);" required="required">
																<option value="">Sélectionner la spécialité</option>
																<?php 
																foreach($specialisation as $row){
																	 ?>
																	
																	<option value="<?php echo $row->idSp;?>">
																		<?php echo $row->libelleSp;?>
																	</option>
																<?php } ?>
															</select>
														</div>

                                                   		<div class="form-group">
															<label for="doctor">
																Médecins
															</label>
															<select name="doctor" class="form-control" id="doctor" required="required">
															<option value="">Sélectionner le médecin</option>
                                                            
															</select>
														</div>

                                                    	<div class="form-group">
															<label for="appointmentdate">Date du RDV</label>
															<input type="date" name="appointmentdate" class="form-control" min="<?php echo date('Y-m-d', strtotime('+0 day')) ?>" required>
														</div>
														<div class="form-group">
															<label for="appointmenttime">Heure du RDV (le format : HH:00)</label>
															<input type="time" name="appttime" class="form-control" placeholder="Entrez l'heure du RDV dans le format HH:00" min="08:00" max="18:00">
														</div>

														<div class="form-group">
															<label for="Motif">RDV Motif</label>
															<select name="Motif" class="form-control" onchange="displayMessages()" required="required">
																<option value="">Sélectionner le motif</option>
																<?php foreach($motifs as $motif) { ?>
																	<option value="<?php echo $motif->idMo;?>"
																		data-consigne="<?php echo $motif->libelleCo;?>"
																		data-piece="<?php echo $motif->libellePi;?>">
																		<?php echo $motif->libelleMo;?>
																	</option>
																<?php } ?>
															</select>
														</div>
													<p> Il faut apporter avec vous : </p>

													<p id="piece-msg"> </p>
													<p> Ne jamais oublier de : </p>
													<p id="consigne-msg"> </p>

                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>

													</form>
												</div>
											</div>
										</div>
									</div>									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
			<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		<!-- start: MAIN JAVASCRIPTS -->
		<?php include('include/import.php');?>

		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
            
// Select the appointment time input field
const apptTimeInput = document.querySelector('input[name="appttime"]');
    
    // Add an event listener to the input field to update the value with the corrected format
    apptTimeInput.addEventListener('blur', function() {
        // Get the input value
        let inputVal = apptTimeInput.value;
        
        // If the input value matches the format HH:MM, update it to HH:00
        if (/^\d{2}:\d{2}$/.test(inputVal)) {
            inputVal = inputVal.substring(0, 2) + ':00';
            apptTimeInput.value = inputVal;
        }
    });
   
	function displayMessages() {
      const selectElement = document.querySelector('select[name="Motif"]');
      const selectedOption = selectElement.options[selectElement.selectedIndex];
      
      if (selectedOption.value === '') {
         document.getElementById("consigne-msg").textContent = "";
         document.getElementById("piece-msg").textContent = "";
         return;
      }
      
      const consigne = selectedOption.getAttribute("data-consigne");
      const piece = selectedOption.getAttribute("data-piece");
	  console.log(consigne);
      
      document.getElementById("consigne-msg").textContent = consigne;
      document.getElementById("piece-msg").textContent = piece;
   }
		</script>
	</body>
</html>
