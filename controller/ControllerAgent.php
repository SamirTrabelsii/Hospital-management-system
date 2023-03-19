<?php 
require_once 'model/modelPersonel.php';
class ControllerAgent {
    //Cette méthode affiche le formulaire pour ajouter un nouvel agent.
    public static function addAgent(){
        require ('vue/admin/add-agent.php');
    }
    //Cette méthode traite les données soumises par le formulaire d'ajout d'agent et ajoute un nouvel agent à la base de données si toutes les données sont valides. Elle redirige ensuite vers la méthode ManageAgent() pour afficher tous les agents dans l'application.
    public static function addAgentProcess(){
        if(isset($_POST['submit'])){
            $nomagent=$_POST['nomagent'];
            $prenomagent=$_POST['prenomagent'];
            $loginagent=$_POST['loginagent'];
            $mdpagent=$_POST['mdpagent'];
            $result=modelPersonel::addAgent($nomagent,$prenomagent,$loginagent,$mdpagent);
            if($result){
                echo "<script>alert('Nouveau agent ajouté avec succés');</script>";
            }
            ControllerAgent::ManageAgent();    
        }
    }
    //Cette méthode récupère l'identifiant de l'agent à modifier et affiche le formulaire pré-rempli pour modifier les données de l'agent correspondant.
    public static function editAgent(){
        $aid=intval($_GET['id']);
        $agent=ModelPersonel::getAgentById($aid);
        require ('vue/admin/edit-agent.php');
    } 
    //Cette méthode traite les données soumises par le formulaire de modification de l'agent et met à jour les informations de l'agent correspondant dans la base de données. Elle redirige ensuite vers la méthode ManageAgent() pour afficher tous les agents dans l'application.
    public static function editAgentProcess(){
        $aid=intval($_GET['id']);
        if(isset($_POST['submit'])){
            $nomagent=$_POST['nomagent'];
            $prenomagent=$_POST['prenomagent'];
            $loginagent=$_POST['loginagent'];
            $mdpagent=$_POST['mdpagent'];
            $result=modelPersonel::editAgent($aid,$nomagent,$prenomagent,$loginagent,$mdpagent);
            if($result){
                echo "<script>alert('Agent modifié avec succés');</script>";
            }
            ControllerAgent::ManageAgent();  
        }
    }
    //Cette méthode récupère l'identifiant de l'agent à supprimer et supprime l'agent correspondant de la base de données. Elle redirige ensuite vers la méthode ManageAgent() pour afficher tous les agents dans l'application.
    public static function deleteAgent(){
        if(isset($_GET['del']))
        {
            $result=modelPersonel::deleteAgent($_GET['id']);
    }
        ControllerAgent::ManageAgent();    
    }
    //Cette méthode récupère tous les agents depuis la base de données et les affiche dans une liste pour l'administrateur.
    public static function ManageAgent(){
        $agents=ModelPersonel::getAllAgents();
        require ('vue/admin/manage-agents.php');
    } 
}

?>