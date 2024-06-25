<?php
require_once("../model/fournisseur.model.php");
require_once("../model/article.model.php");
require_once("../core/controller.php");
class ApproController extends Controller{
    private FournisseurModel $fournisseurModel;
     
    private ArticleModel $articleModel;

    public function __construct() {
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("?controller=securite&action=form-connexion");
        }
        parent::__construct();
        $this->fournisseurModel = new FournisseurModel();
        $this->articleModel = new ArticleModel();
        $this->load();
    }
public function load() {
    if (isset($_REQUEST['action'])) {
        if ($_REQUEST['action'] == "lister-aappro") {
            unset($_POST['action']);
            unset($_POST['controller']);
            $this->listerAppro();
        } elseif ($_REQUEST['action'] == "form-appro") {
            $this->chargerFormulaire();
        }
    } else { 
        $this->listerAppro();
    } 
}

public function listerAppro(): void
{
   
   $this->renderView("appros/lister", [
       'articles' => $this->articleModel,
   ],   );
  

}
public function chargerFormulaire(): void
{
        $this->renderView("appros/form", [
            'fournisseurs'=>$this->fournisseurModel->findAll(),
            'articles'=>$this->articleModel->findAll(),

        ], );;  
}


public function ajouterAppro(): void {
    
}

}