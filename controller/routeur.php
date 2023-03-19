<?php class Routeur{
    public function routerRequete() {
        if (isset($_GET["controller"]) && !empty($_GET["controller"])){
            /** 
             * Cette variable stocke le nom du contrôleur correspondant à l'action demandée.
             * Elle est initialisée à partir du paramètre 'controller' de l'URL et est utilisée pour inclure le fichier PHP correspondant à ce contrôleur.
            */
             $controller = 'Controller'.$_GET['controller'];
            // On recupère l'action passée dans l'URL
            if (isset($_GET["action"]) && !empty($_GET["action"])){
                /**
                 * Cette variable stocke le nom de la méthode du contrôleur à appeler. 
                 * Elle est initialisée à partir du paramètre 'action' de l'URL ou, si ce paramètre n'est pas trouvé, une action par défaut est définie.
                 */
                $action = $_GET['action'];
            }
            else{ 
                $action= "getAll";//action par défaut
            }
        }
        else if (isset($_POST["action"]) && isset($_POST["controller"])){
            $action = $_POST['action'];
            $controller = 'Controller'.$_POST['controller'];
        }
        else{
            $controller="ControllerAccueil";
            $action="acceuil";
        }
        require_once $controller.'.php';
        $controller::$action(); // Appel de la méthode statique $action du Controller
    }
}
?>
