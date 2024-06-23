<?php  
require_once("../model/article.model.php");
require_once("../model/categorie.model.php");
require_once("../model/Type.model.php");
class CategorieController{
    private CategorieModel $categorieModel;

    public function __construct() {
        $this->articleModel = new ArticleModel();
        $this->categorieModel = new CategorieModel();
        $this->typeModel = new TypeModel();
        $this->load();
    }
public function load() {

if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == "lister-categorie") {
       $this-> listerCategorie();
    } elseif ($_REQUEST['action'] == "add-categorie") {
        $this-> ajouterCategorie();
        $this-> listerCategorie();
    }
} else {
    $this-> listerCategorie();
}
}

public function listerCategorie(): void
{
    require_once("../model/categorie.model.php");
    $categories =  $this->categorieModel->findAll();
    require_once("../views/categorie/lister.html.php");

}

public function ajouterCategorie(): void {
    if (isset($_POST['nomCategorie']) && !empty($_POST['nomCategorie'])) {
        $nomCategorie = $_POST['nomCategorie'];

        if ($this->categorieModel->categorieExiste($nomCategorie)) {
            echo "La catégorie existe déjà.";
        } else {
            if ($this->categorieModel->save($nomCategorie)) {
                header("Location: " . WEBROOT . "?controller=categorie&action=lister-categorie");
                exit();
            } else {
                echo "Erreur lors de l'ajout de la catégorie.";
            }
        }
    } else {
        echo "Le nom de la catégorie est obligatoire.";
    }
}}

?>