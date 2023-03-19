<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Modifier Patient</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		
		
		

	</head>
	<body>
	<div id="app">		
	<?php include('include/sidebarAgent.php');?>
		<div class="app-content">
		<?php include('include/header.php');?>
						
			<!-- end: TOP NAVBAR -->
			<div class="main-content" >
				<div class="wrap-content container" id="container">
					<!-- start: PAGE TITLE -->
					<section id="page-title">
						<div class="row">
							<div class="col-sm-8">
								<h1 class="mainTitle">Agent | Modifier Patient</h1>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>Agent</span>
								</li>
								<li class="active">
									<span>Modifier patient</span>
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
												<h5 class="panel-title">Modifier le patient</h5>
											</div>
											<div class="panel-body">
												<form action="index.php?controller=Client&action=editProcess" role="form" name="adddoc" method="post" onSubmit="return valid();">
													<div class="form-group">
														<label for="nss">
															NSS
														</label>
														<input type="text" name="nss" class="form-control"  placeholder="Entrez le NSS"  value="<?php echo $client->nss ;?>" required >
													</div>
													<div class="form-group">
														<label for="first_name">
															Nom du patient
														</label>
														<input type="text" name="first_name" class="form-control"  placeholder="Entrez le nom du patient" value="<?php echo $client->nomCl ;?>" required>
													</div>

													<div class="form-group">
														<label for="second_name">
															Prénom du patient
														</label>
														<input type="text" name="second_name" class="form-control"  placeholder="Entrez le prénom du patient " value="<?php echo $client->prenomCl ;?>" required>
													</div>
													<div class="form-group">
														<label for="address">
															Adresse du patient
														</label>
														<input type="text" name="address" class="form-control"  placeholder="Adresse"  value="<?php echo $client->adresse ;?>" required>
													</div>
													<div class="form-group">
														<label for="num_tel">
															Numéro tel
														</label>
														<input type="text" name="num_tel" class="form-control"  placeholder="Tel : xxxxxxxxxx"  value="<?php echo $client->numTel ;?>" required>
													</div>
													<div class="form-group">
														<label for="datenaissance">
															Date de naissance
														</label>
														<input type="date" class="form-control" name="date_de_naissance" placeholder="date de naissance" value="<?php echo $client->dateNais ;?>" required>
													</div>
													<div class="form-group">
														<label for="">département de naissance</label>
														<input type="number" class="form-control" id="dep_naissance" name="dep_naissance" value="<?php echo $client->departementNais ;?>" onchange="checkDepartement()"><br>
														<div class="form-group">
															<div id="pays_naissance_div" style="display: none;">
																<label for="pays_naissance">Pays de naissance :</label>
																<input type="text" class="form-control" id="pays_naissance" name="pays_naissance" value="<?php echo $client->departementNais ;?>" ><br>
															</div>
														</div>
													</div>
													<div class="form-actions">
														<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
															Valider <i class="fa fa-arrow-circle-right"></i>
														</button>
													</div>
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

		<?php include('include/footer.php');?>
		
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/swichery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
            function checkDepartement() {
                let depField = document.getElementById("dep_naissance");
                let depValue = depField.value;
                if (depValue.length == 2 && depValue != "99") {
                    return;
                }
                depField.value = "99";
                let paysDiv = document.getElementById("pays_naissance_div");
                paysDiv.style.display = "block";
            }
			document.querySelector('input[name="num_tel"]').addEventListener('change', function (evt) {
        var phoneNumber = evt.target.value;
        if (!(/^\d{10}$/.test(phoneNumber))) {
            evt.target.setCustomValidity("Please enter a 10-digit phone number");
        } else {
            evt.target.setCustomValidity("");
        }
    });
		</script>
		
	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>	
		
	</body>
	<!-- end: BODY -->
</html>