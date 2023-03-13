<?php //var_dump($client) 
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Payement</title>
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


	</head>
	<body>
		<div id="app">		
			<?php include('include/sidebarAgent.php');?>
			<div class="app-content">


            

			<?php include('include/header.php');?>  
			<div class="container-fluid container-fullw bg-white">
						
			<div class="row">
							<div class="main-content">
							<div class="panel panel-white">
											<div class="panel-body">

												<div class="row">
													<div class="col-md-3"><h4><b>Nom et prénom du patient : </b> <?php echo $client->nomCl." ".$client->prenomCl ;?></h4></div>
													<div class="col-md-6"><h4><b>ayant comme solde  : </b> <?php echo $client->solde ;?></h4></div>

													<div class="col-md-6"><h4><b>Prix du consultation à payer  : </b> <?php echo $rdv->prixMo ;?></h4> date vers le :<?php echo $rdv->dateRDV ;?> </div>
												</div></br>
												<button onclick="window.location.href = 'index.php?controller=Client&action=payementProcess&NSS=<?php echo $rdv->nss;?>&idRDV=<?php echo $rdv->idRDV; ?>'"  name="registration" class="btn btn-primary ">Payer </button>

			          
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
		</script>
	</body>
</html>
