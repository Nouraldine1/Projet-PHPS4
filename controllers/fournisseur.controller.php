<?php  
require_once("../model/article.model.php");
require_once("../model/categorie.model.php");
require_once("../model/fournisseur.model.php");
require_once("../model/type.model.php");
require_once("../core/Controller.php");
class FournisseurController extends controller{
    private FournisseurModel $FournisseurModel;
    private  array    $datas ;

    public function __construct() {
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("?controller=securite&action=form-connexion");
        }
        parent::__construct();
        $this->fournisseurModel = new FournisseurModel();
        $this->load();
    }
public function load()
{
    if (isset($_REQUEST['action'])) {
        if ($_REQUEST['action'] == "lister-fournisseur") {
            unset($_POST['action']);
            unset($_POST['controller']);
           $this->listerFournisseur();
        } 
    } else {
        $this->listerFournisseur();
    }
}


public function listerFournisseur(): void
{
    $this->renderView("type/lister", [
        'fournisseurs' => $this->FournisseurModel->findAll() 
    ], );;  

}



}




?>