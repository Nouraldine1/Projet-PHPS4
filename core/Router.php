<?php  

class Router {

    public function Run ()
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
            } else {
                require_once ("../controllers/article.controller.php");
                $controller = new ArticleController();
            }
        } else {
            require_once ("../controllers/article.controller.php");
            $controller = new ArticleController();
        }
    }
   
}
?>