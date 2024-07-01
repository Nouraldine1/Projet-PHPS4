<?php
require_once("../model/articleVente.model.php");
require_once("../model/categorie.model.php");
require_once("../model/type.model.php");
require_once("../core/controller.php");
class ArticleVenteController extends Controller{
    private ArticleVenteModel $articleVenteModel;
    private CategorieModel $categorieModel;
    private TypeModel $typeModel;

   

    public function __construct() {
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("?controller=securite&action=form-connexion");
        }
        parent::__construct();
        $this->articleVenteModel = new ArticleVenteModel();
        $this->categorieModel = new CategorieModel();
        $this->typeModel = new TypeModel();
        $this->load();
    }
public function load() {
    if (isset($_REQUEST['action'])) {
        if ($_REQUEST['action'] == "lister-articleVente") {
            unset($_POST['action']);
            unset($_POST['controller']);
            $this->listerArticleVente();
        } elseif ($_REQUEST['action'] == "form-articleVente") {
            $this->chargerFormulaire();
        }elseif ($_REQUEST['action'] == "add-articleVente") {
            $this->ajouterArticleVente();
        }elseif ($_REQUEST['action'] == "Fermer-formVente") {
            $this->listerArticleVente();
        }
    } else { 
        $this->listerArticleVente();
    } 
}

public function listerArticleVente(): void
{
   
   $this->renderView("articles/lister", [
       'articles' => $this->articleVenteModel->findAll(),
   ],   );
  

}
public function chargerFormulaire(): void
{
        $this->renderView("articlesVentes/form", [
            'categories'=>$this->categorieModel->findAll(),
            'types'=>$this->typeModel->findAll()
        ], );;  
}


public function ajouterArticleVente(): void {
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
    if ($this->articleVenteModel->articleVenteExiste($libelle)) {
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
    $result = $this->articleVenteModel->save($libelle, $prix,  $qteStock, $categorie_id, $type_id);

    if ($result) {
        // header("Location: " . WEBROOT . "?controller=article&action=lister-article");
          $this->redirectToRoute("?controller=article&action=lister-article");
        
    } else {
        echo "Erreur lors de l'ajout de l'article.";
    }
}

}