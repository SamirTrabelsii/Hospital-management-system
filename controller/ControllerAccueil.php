<?php 


class ControllerAccueil {
    //Cette classe définit différentes fonctions pour diriger l'utilisateur vers différentes vues selon son rôle.
    public static function acceuil() {
        require ('vue/login.php'); //redirige vers la vue
    }
    public static function admin(){
        require ("vue/admin/index.php");
    }
    public static function doctor(){
        require ("vue/doctor/index.php");
    }
    public static function client(){
        require ("vue/agent/index.php");
    }
}
?>