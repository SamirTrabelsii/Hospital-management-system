<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Consulter synthèse</title>
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
	<body class="login">
	<div id="app">		
			<?php include('include/sidebarAgent.php');?>
			<div class="app-content">
				
			<?php include('include/header.php');?>
		<!-- start: REGISTRATION -->
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
				<h2>Consulter synthèse</h2>
				</div>
				<!-- start: REGISTER BOX -->
				<div class="box-register">
					<form action="index.php?controller=Client&action=consultationPatient" name="registration" id="registration"  method="post">
						<fieldset>
							<legend>
								Consulter la synthèse du patient
							</legend>
                                <p>
                                    Entrez le NSS :
                                </p>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nss" placeholder="NSS Patient" required>
                                </div>
							<div class="form-actions">
								
								<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
									Consulter <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>
                    <div class="box-register">
                        <form>
                                <legend>
									NSS oublié ?
								</legend>
                            <div class="form-group">
                                <label for="nom">Nom :</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="form-group">
                                <label for="date_naissance">Date de naissance :</label>
                                <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>

                            </div>
                                <button type="button" onclick="getNss()">Obtenir NSS</button>

                                <div id="nss_div"></div>
                        </form> 
                    </div>
				</div>
			</div>
		</div>
		</div>
		<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
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
            function getNss() {
                let nom = document.getElementById("nom").value;
                let date_naissance = document.getElementById("date_naissance").value;

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "vue/agent/get_nss.php", true);
             
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                    let nss_div = document.getElementById("nss_div");
                    nss_div.innerHTML = "Le numéro de sécurité sociale de " + nom + " est : " + this.responseText;
                    }
                };
                xhr.send("nom=" + encodeURIComponent(nom) + "&date_naissance=" + encodeURIComponent(date_naissance));
                }
            

            </script>
		
	</body>
	<!-- end: BODY -->
</html>