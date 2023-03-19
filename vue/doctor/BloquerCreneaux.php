<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Médecin | Dashboard</title>
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
		<?php include('include/sidebarDoctor.php');?>
			<div class="app-content">
      <?php include('include/header.php');?>  
        <div class="container-fluid container-fullw bg-white">          
          <div class="row">
            <div class="main-content">
            <!-- code here  -->
              <form action="index.php?controller=Creneaux&action=bloquerCreneauxProcess" method="post">
                <div class="margin-left-30">
                  <label for="nb_creneaux ">
                    <h4>Nombre de créneaux à bloquer: </h4>
                  </label>
                  <input type="number" id="nb_creneaux" name="nb_creneaux" min="1" required>
                  <button type="submit">Enregistrer</button>
                </div>
                <div class="margin-left-30"><div id="creneaux_container"></div></div>
              </form>
            <!-- fin code -->      
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
		const nbCreneauxInput = document.getElementById('nb_creneaux');
  const creneauxContainer = document.getElementById('creneaux_container');

  // Add an event listener to the nbCreneauxInput field to generate the appointment time inputs
  nbCreneauxInput.addEventListener('blur', function() {
    // Clear any existing appointment time inputs
    creneauxContainer.innerHTML = '';

    // Get the number of appointment times to create
    const nbCreneaux = parseInt(nbCreneauxInput.value);

    // Create a new appointment time input for each appointment time
    for (let i = 0; i < nbCreneaux; i++) {
      // Create the container div
      const container = document.createElement('div');
      container.classList.add('creneau-container');

      // Create the date input
      const dateLabel = document.createElement('label');
      dateLabel.innerText = 'Date:';
      const dateInput = document.createElement('input');
      dateInput.type = 'date';
      dateInput.name = 'date[]';
      dateInput.required = true;
      container.appendChild(dateLabel);
      container.appendChild(dateInput);

      // Create the time input
      const timeLabel = document.createElement('label');
      timeLabel.innerText = 'Heure:';
      const timeInput = document.createElement('input');
      timeInput.type = 'time';
      timeInput.name = 'heure[]';
      timeInput.required = true;
      timeInput.min = '08:00';
      timeInput.max = '18:00';
      timeInput.step = '3600'; // 1 hour
      timeInput.addEventListener('blur', function() {
        // Get the input value
        let inputVal = timeInput.value;

        // If the input value matches the format HH:MM, update it to HH:00
        if (/^\d{2}:\d{2}$/.test(inputVal)) {
            inputVal = inputVal.substring(0, 2) + ':00';
            timeInput.value = inputVal;
        }
      });
      container.appendChild(timeLabel);
      container.appendChild(timeInput);

      // Create the raison d'absence input
      const raisonLabel = document.createElement('label');
      raisonLabel.innerText = 'Raison d\'absence:';
      const raisonInput = document.createElement('input');
      raisonInput.type = 'text';
      raisonInput.name = 'raison[]';
      raisonInput.required = true;
      container.appendChild(raisonLabel);
      container.appendChild(raisonInput);

      // Add the container to the creneauxContainer
      creneauxContainer.appendChild(container);
    }
  });
        </script>
	</body>
</html>
