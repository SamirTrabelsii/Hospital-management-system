<?php 
require_once 'model/modelPersonel.php';
class ControllerMedcin {
    
    public static function addDoctor(){
        require_once ('model/ModelSpecialisation.php');
        $specialisation=ModelSpecialisation::getAll();
        require ('vue/admin/add-doctor.php');
    }
    public static function ManageDoctor(){
        require_once ('model/ModelSpecialisation.php');
        $specialisation=ModelSpecialisation::getAll();
        $doctors=ModelPersonel::getAllDoctors();
        require ('vue/admin/manage-doctors.php');
    }
    public static function specialiste(){
        require_once ('model/ModelSpecialisation.php');
        $specialisation=ModelSpecialisation::getAll();
        require ('vue/admin/doctor-specilization.php');
    }
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
    public static function deleteSpecialisation(){
        require_once ('model/ModelSpecialisation.php');
        if(isset($_GET['del']))
		  {
            $result=ModelSpecialisation::delete($_GET['id']);
		  }
        ControllerMedcin::specialiste();
    }


    public static function editDoctor(){
        $did=intval($_GET['id']);
        $doctor=ModelPersonel::getDoctorById($did);
        require ('vue/admin/edit-doctor.php');

    } 

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
    public static function deleteDoctor(){
        if(isset($_GET['del']))
        {
        $result=modelPersonel::deleteDoctor($_GET['id']);
    }
    ControllerMedcin::ManageDoctor();    
    }

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