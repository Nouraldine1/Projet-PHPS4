<?php
require_once("../model/article.model.php");
require_once("../model/categorie.model.php");
require_once("../model/Type.model.php");
class ArticleController {
    private ArticleModel $articleModel;
    private CategorieModel $categorieModel;
    private TypeModel $typeModel;

    public function __construct() {
        $this->articleModel = new ArticleModel();
        $this->categorieModel = new CategorieModel();
        $this->typeModel = new TypeModel();
        $this->load();
    }
public function load() {
    if (isset($_REQUEST['action'])) {
        if ($_REQUEST['action'] == "lister-article") {
            // unset($_REQUEST['action']);
            // unset($_REQUEST['controller']);
            $this->listerArticle();
        } elseif ($_REQUEST['action'] == "form-article") {
            $this->chargerFormulaire();
        }elseif ($_REQUEST['action'] == "add-article") {
            $this->ajouterArticle();
        }elseif ($_REQUEST['action'] == "Fermer-form") {
            $this->listerArticle();
        }
    } else {
        $this->listerArticle();
    }
}

public function listerArticle(): void
{
    /* Au prealable, avant de charger la vue, il faudra faire appel au model 
        pour chercher les donnees de la table article. */
    // require_once("../model/article.model.php");
    $articles = $this->articleModel->findAll();
    // Chargement de la vue     
    //var_dump($articles);
    require_once("../views/Articles/lister.html.php");

}
public function chargerFormulaire(): void
{
    $types = $this->typeModel->findAll();
    $categories =  $this->categorieModel->findAll();
    require_once("../views/Articles/form.html.php");
}


public function ajouterArticle(): void {
    // Validation des donnees du formulaire
    $libelle = $_POST['libelle'];
    $prix = $_POST['prix'];
    $qteStock = $_POST['qteStock'];
    $categorie_id = $_POST['categorie'];
    $type_id = $_POST['type'];

    // Verification des valeurs
    if (empty($libelle) || $categorie_id <= 0 || $type_id <= 0) {
        echo "Erreur : tous les champs sont obligatoires et doivent contenir des valeurs valides,reessayer";
        $this->chargerFormulaire();
        return;
    }

    // Verification si le libelle est unique
    require_once("../model/article.model.php");
    if ($this->articleModel->articleExiste($libelle)) {
        echo "Erreur : Le libelle de l'article existe deja,reessayer";
        $this->chargerFormulaire();
        return;
    }

    // Verification si les prix et la quantite sont positifs
    if ($prix <= 0 || $qteStock <= 0) {
        echo "Erreur : Le prix et la quantite doivent être des valeurs positives,reessayer";
        $this->chargerFormulaire();
        return;
    }

    // Inserer l'article dans la base de donnees
    $result = $this->articleModel->save($libelle, $prix,  $qteStock, $categorie_id, $type_id);

    if ($result) {
        header("Location: " . WEBROOT . "?action=lister-article");
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'article.";
    }
}

}