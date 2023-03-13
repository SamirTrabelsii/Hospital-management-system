<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Synthèse Patient</title>
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
			<div class="main-content" >
				<div class="wrap-content container" id="container">
					<!-- start: PAGE TITLE -->
					<section id="page-title">
						<div class="row">
							<div class="col-sm-8">
								<h1 class="mainTitle"> Agent | Le Synthèse du Patient</h1>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>Agent</span>
								</li>
								<li class="active">
									<span>Synthèse patient</span>
								</li>
							</ol>
						</div>
					</section>  
				<div class="container-fluid container-fullw bg-white">	
					<div class="row">
							<p style="color:red;"><?php //echo htmlentities($_SESSION['msg']);?>
							<?php //echo htmlentities($_SESSION['msg']="");?></p>	
							<?php 
							$cnt=0;
							?>
							<div class="row margin-top-30">
								<div class="col-lg-12">
								<div class="panel panel-white">
											<div class="panel-body">

												<div class="row">
													<div class="col-md-3"><h4><b>Nom du patient : </b> <?php echo $client->nomCl ;?></h4></div>
													<div class="col-md-6"><h4><b>Prénom du patient : </b> <?php echo $client->prenomCl ;?></h4></div>
												</div></br>
												<div class="form-group">
														<h4 for="address">
															<b>Le numéro de sécurité sociale du patient : </b><?php echo $client->nss ;?>
														</h4>
													</div></br>
													<div class="form-group">
														<h4 for="address">
															<b>Adresse du patient : </b><?php echo $client->adresse ;?>
														</h4>
													</div></br>
													<div class="form-group">
														<h4 for="num_tel">
															<b>Numéro de téléphone : </b><?php echo $client->numTel ;?>
														</h4>
													</div></br>
													<div class="form-group">
														<h4 for="datenaissance">
															<b>Date de naissance : </b><?php echo $client->dateNais ;?>
														</h4>
													</div></br>
													<div class="form-group">
														<h4 for="solde">
															<b>Solde du compte : </b><?php echo $client->solde ;?>
														</h4>
													</div></br>
													<div class="form-group">
														<h4 for="pays_naissance">
															<b>Lieu de naissance : </b><?php echo $client->departementNais ;?>
														</h4>
													</div></br>
											</div>
										</div>
									<div class="panel panel-white">
										<div class="panel-heading">
											<h5 class="panel-title">Débiter le compte</h5>
										</div>
										<div class="panel-body">
											<form action="index.php?controller=Client&action=addSolde&NSS=<?php echo $nss ?>" role="form" name="adddoc" method="post" ">
												<div class="form-group">
													<label for="solde">
														montant :
													</label>
													<input type="number" name="solde" class="form-control" required>
												</div>
											</div>	

												<button type="submit" class="btn btn-primary  margin-left-30">Valider</button>
											</form>	
											<button onclick="window.location.href = 'index.php?controller=Client&action=addRdv&NSS=<?php echo $client->nss; ?>'" class="btn btn-primary ">Ajouter RDV</button>
											<button onclick="window.location.href = 'index.php?controller=Client&action=editPatient&NSS=<?php echo $client->nss; ?>'" class="btn btn-primary ">Modifer Patient</button>

									<table class="table table-hover" id="sample-table-1">
										<thead>
											<tr>
												<th class="center">#</th>
												<th class="hidden-xs">Nom du médecin</th>
												<th>Spécialité</th>
												<th>RDV Date / Heure </th>
												<th>Motif </th>
												<th>Prix </th>
												<th>Etat</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											foreach ($rdvs as $rdv) {
												?>	
												<tr>
												<td class="center"><?php  echo $cnt;?>.</td>
												<td class="hidden-xs"><?php echo $rdv->nomPers.' '.$rdv->prenomPers ;?></td>
												<td><?php echo $rdv->libelleSp;?></td>
												<td><?php echo $rdv->dateRDV;?></td>
												<td><?php echo $rdv->libelleMo;?></td>
												<td><?php echo $rdv->prixMo;?></td>
												<td><?php echo $rdv->etatRDV;?></td> 
												<td><?php if ($rdv->etatRDV == 'En attente') { ?>
														<a href="index.php?controller=Client&action=payement&NSS=<?php echo $rdv->nss;?>&idRDV=<?php echo $rdv->idRDV; ?>" name="registration">Payer</a>
													<?php } else { ?>
														effectué
													<?php } ?></td>
												</tr>
											
											<?php 
											$cnt=$cnt+1;
											}?>  
										</tbody>
									</table>
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
	</body>
</html>
