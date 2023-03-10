<?php 
require_once 'model/modelPersonel.php';
class ControllerAgent {
    
    public static function addAgent(){
        require ('vue/admin/add-agent.php');
    }
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

    public static function editAgent(){
        $aid=intval($_GET['id']);
        $agent=ModelPersonel::getAgentById($aid);
        require ('vue/admin/edit-agent.php');
    } 
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
    public static function deleteAgent(){
        if(isset($_GET['del']))
        {
        $result=modelPersonel::deleteAgent($_GET['id']);
    }
    ControllerAgent::ManageAgent();    
    }

    public static function ManageAgent(){
        $agents=ModelPersonel::getAllAgents();
        require ('vue/admin/manage-agents.php');
    } 
}

?>