<?php 
require_once 'model/ModelMotif.php';
require_once 'model/modelPersonel.php';
require_once 'model/modelRdv.php';


class ControllerAdmin {
// * LES FONCTIONS DE GESTION DES MOTIFS *
    //Cette fonction récupère tous les motifs depuis la base de données et affiche la vue "manage-motifs.php".
    public static function ManageMotif(){
        $motifs=ModelMotif::getAllMotifs();
        require ('vue/admin/manage-motifs.php');
    }
    //Cette fonction affiche la vue "add-motif.php".
    public static function addMotif(){
        require ('vue/admin/add-motif.php');
    }
    //Cette fonction ajoute un nouveau motif en récupérant les données du formulaire et en utilisant la fonction "addM" de la classe "ModelMotif". Si l'ajout est réussi, la fonction affiche un message d'alerte avec JavaScript.
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
    //Cette fonction récupère les informations d'un motif à partir de son ID et affiche la vue "edit-motif.php".
    public static function editMotif(){
        $mid=intval($_GET['id']);
        $motif=ModelMotif::getMotifById($mid);
        require ('vue/admin/edit-motif.php');
    } 
    //Cette fonction modifie les informations d'un motif en récupérant les données du formulaire et en utilisant la fonction "editM" de la classe "ModelMotif". Si la modification est réussie, la fonction affiche un message d'alerte avec JavaScript et affiche la vue "manage-motifs.php".
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
    //Cette fonction supprime un motif en utilisant la fonction "deleteM" de la classe "ModelMotif". Elle redirige ensuite vers la vue "manage-motifs.php".
    public static function deleteMotif(){
        if(isset($_GET['del']))
        {
            $motifet=ModelRdv::getRdvByMotif($_GET['id']);
            if($motifet){
                echo "<script>alert('vous ne pouvez pas supprimer une motif qui est déja utilisé');</script>";
                ControllerAdmin::ManageMotif();    
            }else{
                $result=ModelMotif::deleteM($_GET['id']);
            }            
        }
        ControllerAdmin::ManageMotif();    
    }
// ** LES FONCTIONS DE GESTION DU DIRECTEUR **
    //Cette fonction récupère les informations d'un directeur à partir de son ID et affiche la vue "edit-admin.php".
    public static function editAdmin(){
        $dirid=intval($_GET['id']);
        $directeur=ModelPersonel::getDirecteurById($dirid);
        require ('vue/admin/edit-admin.php');
    } 
    //Cette fonction modifie les informations d'un directeur en récupérant les données du formulaire et en utilisant la fonction "editDirecteur" de la classe "ModelPersonel". Si la modification est réussie, la fonction affiche un message d'alerte avec JavaScript et affiche la vue "manage-admin.php".
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
    //Cette fonction récupère tous les directeurs depuis la base de données et affiche la vue "manage-admin.php".
    public static function ManageAdmin(){
        $directeurs=ModelPersonel::getAllDirecteur();
        require ('vue/admin/manage-admin.php');
    } 
}

?>
