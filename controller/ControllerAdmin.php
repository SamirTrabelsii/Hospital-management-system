<?php 
require_once 'model/ModelMotif.php';
require_once 'model/modelPersonel.php';

class ControllerAdmin {
    // * LES FONCTIONS DE GESTION DES MOTIFS *
    public static function ManageMotif(){
        $motifs=ModelMotif::getAllMotifs();
        require ('vue/admin/manage-motifs.php');
    }

    public static function addMotif(){
        require ('vue/admin/add-motif.php');
    }

    public static function addMotifProcess(){
        if(isset($_POST['submit'])){
            $libelleMo=$_POST['libelleMo'];
            $prixMo=$_POST['prixMo'];
            $libellePi=$_POST['libellePi'];
            $libelleCo=$_POST['libelleCo'];
            $result=ModelMotif::addM($libelleMo,$prixMo,$libellePi,$libelleCo);
            if($result){
                echo "<script>alert('Motif ajouté avec succés');</script>";
                }
            }
        ControllerAdmin::addMotif();    
    }

    public static function editMotif(){
        $mid=intval($_GET['id']);
        $motif=ModelMotif::getMotifById($mid);
        require ('vue/admin/edit-motif.php');
    } 

    public static function editMotifProcess(){
        $mid=intval($_GET['id']);
        if(isset($_POST['submit'])){
            $libelleMo=$_POST['libelleMo'];
            $prixMo=$_POST['prixMo'];
            $libellePi=$_POST['libellePi'];
            $libelleCo=$_POST['libelleCo'];
            $result=ModelMotif::editM($mid,$libelleMo,$prixMo,$libellePi,$libelleCo);
            if($result){
                echo "<script>alert('Motif modifié avec succés');</script>";
                
                }
                ControllerAdmin::ManageMotif();  
        }
    }
    public static function deleteMotif(){
        if(isset($_GET['del']))
        {
        $result=ModelMotif::deleteM($_GET['id']);
    }
    ControllerAdmin::ManageMotif();    
    }
    // ** LES FONCTIONS DE GESTION DU DIRECTEUR **



    public static function editAdmin(){
        $dirid=intval($_GET['id']);
        $directeur=ModelPersonel::getDirecteurById($dirid);
        require ('vue/admin/edit-admin.php');
    } 
    public static function editAdminProcess(){
        $dirid=intval($_GET['id']);
        if(isset($_POST['submit'])){
            $nomdirecteur=$_POST['nomdirecteur'];
            $prenomdirecteur=$_POST['prenomdirecteur'];
            $logindirecteur=$_POST['logindirecteur'];
            $mdpdirecteur=$_POST['mdpdirecteur'];
            $result=modelPersonel::editDirecteur($dirid,$nomdirecteur,$prenomdirecteur,$logindirecteur,$mdpdirecteur);
            if($result){
                echo "<script>alert('Directeur modifié avec succés');</script>";
                
                }
                ControllerAdmin::ManageAdmin();  
        }
    }

    public static function ManageAdmin(){
        $directeurs=ModelPersonel::getAllDirecteur();
        require ('vue/admin/manage-admin.php');
    } 
}

?>
