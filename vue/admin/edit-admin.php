<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Directeur | Modifier le directeur</title>
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
		<?php include('include/sidebar.php');?>
			<div class="app-content">
				
						<?php include('include/header.php');?>
						<!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
					
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Directeur | Modifier le directeur</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Directeur</span>
									</li>
									<li class="active">
										<span>Modifier le directeur</span>
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
													<h5 class="panel-title">Modifier directeur</h5>
												</div>
												<div class="panel-body">
												<form action="index.php?controller=Admin&action=editAdminProcess&id=<?php echo $dirid; ?>" role="form" name="editadmin" method="post" onSubmit="return valid();">
                                                            <div class="form-group">
															    <label for="nomdirecteur">Nom du directeur</label>
	                                                            <input type="text" name="nomdirecteur" class="form-control" value="<?php echo $directeur->nomPers ;?>" >
													    	</div>
                                                            <div class="form-group">
															    <label for="prenomdirecteur">Prénom du directeur</label>
					                                            <input name="prenomdirecteur" class="form-control" value="<?php echo $directeur->prenomPers;?>" >
													    	</div>
                                                            <div class="form-group">
														        <label for="logindirecteur">Login du directeur</label>
														        <input type="text" name="logindirecteur" class="form-control"   value="<?php echo $directeur->login ;?>">
														    </div>	
                                                            <div class="form-group">
														        <label for="mdpdirecteur">Mot de passe directeur</label>
														        <input type="text" name="mdpdirecteur" class="form-control"   value="<?php echo $directeur->mdp ;?>">
														    </div>															
														<button type="submit" name="submit" class="btn btn-o btn-primary">
															Modifier
														</button>
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
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
