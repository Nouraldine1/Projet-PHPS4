<?php  
require_once("../model/article.model.php");
require_once("../model/categorie.model.php");
require_once("../model/type.model.php");
require_once("../core/controller.php");

class CategorieController extends Controller{
    private CategorieModel $categorieModel;

    public function __construct() {
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("?controller=securite&action=form-connexion");
        }
        parent::__construct();
        $this->articleModel = new ArticleModel();
        $this->categorieModel = new CategorieModel();
        $this->typeModel = new TypeModel();
        $this->load();
    }
public function load() {

if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == "lister-categorie") {
        unset($_POST['action']);
        unset($_POST['controller']);
       $this-> listerCategorie();
    } elseif ($_REQUEST['action'] == "add-categorie") {
        $this-> ajouterCategorie();
        $this-> listerCategorie();
    }
} else {
    $this-> listerCategorie();
}
}

public function listerCategorie(): void {
    $this->renderView("categorie/lister", [
        'categories' => $this->categorieModel->findAll() // Utilisez 'categories' comme clé
    ]);
}

public function ajouterCategorie(): void {
    if (isset($_POST['nomCategorie']) && !empty($_POST['nomCategorie'])) {
        $nomCategorie = $_POST['nomCategorie'];

        if ($this->categorieModel->categorieExiste($nomCategorie)) {
            echo "La catégorie existe déjà.";
        } else {
            if ($this->categorieModel->save($nomCategorie)) { 
                 $this->rendirectToRoute("?controller=article&action=lister-article");
            } else {
                echo "Erreur lors de l'ajout de la catégorie.";
            }
        }
    } else {
        echo "Le nom de la catégorie est obligatoire.";
    }
}}

?>