<?php
session_start();
require_once 'model/modelPersonel.php';

class ControllerPersonel {
    public static function login(){
        if(isset($_POST['submit']))
        {
            $login=$_POST['username'];
            $mdp=$_POST['password'];
            $result=modelPersonel::login($login,$mdp);
            if(!$result){
                $_SESSION['errmsg']="login ou mot de passe invalide";
                require("vue/login.php");
            }
            else{
                $_SESSION['login']=$_POST['username'];
                $_SESSION['idPers']=$result->idPers;
                switch ($result->idCat) {
                    case 0:
                        require ('vue/admin/index.php');
                        break;
                    case 1:
                        require ('vue/doctor/index.php');
                        break;
                    case 2:
                        require ('vue/agent/index.php');
                        break;
                }
            }
        }
    }public static function logout(){
        $_SESSION['login']=="";
        $_SESSION['idPers']="";
        $_SESSION['errmsg']="Déconnexion réussie.";
        require("vue/login.php");
    }
}
?>