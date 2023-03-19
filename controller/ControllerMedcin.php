<?php 
require_once 'model/modelPersonel.php';
class ControllerMedcin {
    //Affiche la vue permettant d'ajouter un médecin
    public static function addDoctor(){
        require_once ('model/ModelSpecialisation.php');
        $specialisation=ModelSpecialisation::getAll();
        require ('vue/admin/add-doctor.php');
    }
    //Affiche la vue permettant de gérer les médecins
    public static function ManageDoctor(){
        require_once ('model/ModelSpecialisation.php');
        $specialisation=ModelSpecialisation::getAll();
        $doctors=ModelPersonel::getAllDoctors();
        require ('vue/admin/manage-doctors.php');
    }
    //Affiche la vue permettant de gérer les spécialisations des médecins
    public static function specialiste(){
        require_once ('model/ModelSpecialisation.php');
        $specialisation=ModelSpecialisation::getAll();
        require ('vue/admin/doctor-specilization.php');
    }
    //Ajoute une spécialisation pour les médecins
    public static function addSpecialisation(){
        require_once ('model/ModelSpecialisation.php');
        if(isset($_POST['submit'])){
            $docspecialization=$_POST['doctorspecilization'];
            $result=ModelSpecialisation::add($docspecialization);
            if($result){
                echo "<script>alert('Spécialité ajoutée avec succés');</script>";
            }
        }
        ControllerMedcin::specialiste();
    }
    //Supprime une spécialisation pour les médecins
    public static function deleteSpecialisation(){
        require_once ('model/ModelSpecialisation.php');
        if(isset($_GET['del']))
		  {
            $result=ModelSpecialisation::delete($_GET['id']);
		  }
        ControllerMedcin::specialiste();
    }

    //Affiche la vue permettant de modifier un médecin
    public static function editDoctor(){
        $did=intval($_GET['id']);
        $doctor=ModelPersonel::getDoctorById($did);
        require ('vue/admin/edit-doctor.php');

    } 
    //Cette méthode traite les données soumises par le formulaire d'ajout d'un medecin et ajoute un nouvel medecin à la base de données si toutes les données sont valides. Elle redirige ensuite vers la méthode ManageDoctor() pour afficher tous les medecins dans l'application.
    public static function addDoctorProcess(){
        if(isset($_POST['submit'])){
            $docspecialization=$_POST['Doctorspecialization'];
            $nommedecin=$_POST['nommedecin'];
            $prenommedecin=$_POST['prenommedecin'];
            $loginmedecin=$_POST['loginmedecin'];
            $mdpmedecin=$_POST['mdpmedecin'];
            $result=modelPersonel::addDoctor($nommedecin,$prenommedecin,$loginmedecin,$mdpmedecin,$docspecialization);
            if($result){
                echo "<script>alert('Médecin ajouté avec succés');</script>";
            }
            ControllerMedcin::ManageDoctor();    
        }
    }
    //Cette méthode récupère l'identifiant du medecin à supprimer et supprime le medecin correspondant de la base de données. Elle redirige ensuite vers la méthode ManageDoctor() pour afficher tous les medecins dans l'application.
    public static function deleteDoctor(){
        if(isset($_GET['del']))
        {
        $result=modelPersonel::deleteDoctor($_GET['id']);
    }
    ControllerMedcin::ManageDoctor();    
    }
    //Cette méthode traite les données soumises par le formulaire de modification du medecin et met à jour les informations du medecin correspondant dans la base de données. Elle redirige ensuite vers la méthode ManageDoctor() pour afficher tous les medecins dans l'application.
    public static function editDoctorProcess(){
        if(isset($_POST['submit'])){
            $docspecialization=$_POST['Doctorspecialization'];
            $nommedecin=$_POST['nommedecin'];
            $prenommedecin=$_POST['prenommedecin'];
            $loginmedecin=$_POST['loginmedecin'];
            $mdpmedecin=$_POST['mdpmedecin'];
            $result=modelPersonel::editDoctor($_GET['id'],$nommedecin,$prenommedecin,$loginmedecin,$mdpmedecin,$docspecialization);
            if($result){
                echo "<script>alert('Médecin modifié avec succés');</script>";
            }
            ControllerMedcin::ManageDoctor();  
        }

    } 
}
?>