<?php  

class Router {

    public static function run ()
    {
        if (isset($_REQUEST['controller'])) {
            if ($_REQUEST['controller'] == "article") {
                require_once ("../controllers/article.controller.php");
                $controller = new ArticleController();
            } elseif ($_REQUEST['controller'] == "categorie") {
                require_once ("../controllers/categorie.controller.php");
                $controller = new CategorieController();
            } elseif ($_REQUEST['controller'] == "type") {
                require_once ("../controllers/type.controller.php");
                $controller = new TypeController();
            } elseif ($_REQUEST['controller'] == "securite") {
                require_once ("../controllers/securite.controller.php");
                $controller = new SecuriteController();
            } elseif ($_REQUEST['controller'] == "appro") {
                require_once ("../controllers/appro.controller.php");
                $controller = new ApproController();
            } elseif ($_REQUEST['controller'] == "user") {
                require_once ("../controllers/user.controller.php");
                $controller = new UserController();
            }
        } else {
            require_once ("../controllers/securite.controller.php");
            $controller = new SecuriteController();
        }
    }
   
}
?>