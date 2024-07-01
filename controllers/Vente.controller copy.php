<?php
require_once("../model/fournisseur.model.php");
require_once("../model/panier.model.php");
require_once("../model/article.model.php");
require_once("../model/Vente.model.php");
require_once("../core/controller.php");
class VenteController extends Controller{
    private FournisseurModel $fournisseurModel;
     
    private ArticleModel $articleModel;

    private PanierModel  $PanierModel;
    private ApproModel  $approModel;

    public function __construct() {
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("?controller=securite&action=form-connexion");
        }
        parent::__construct();
        $this->fournisseurModel = new FournisseurModel();
        $this->articleModel = new ArticleModel();
        $this->venteModel = new VenteModel();
        $this->load();
    }
public function load() {
    if (isset($_REQUEST['action'])) {
        if ($_REQUEST['action'] == "lister-vente") {
            unset($_POST['action']);
            unset($_POST['controller']);
            $this->listerAppro();
        } elseif ($_REQUEST['action'] == "form-vente") {
            $this->chargerFormulaire();
        }elseif ($_REQUEST['action'] == "add-article") {
            $this-> ajouterArticleDansAppro($_POST);
        }elseif ($_REQUEST['action'] == "add-vente") {
            $this-> ajouterAppro();
        }elseif ($_REQUEST['action'] == "filtrer-vente") {
            $this->FilterAppro();
        }elseif ($_REQUEST['action'] == "show-appro-details") {
            $approId = $_GET['id'];
            $this->showApproDetails($approId);
        }
        
    } else { 
        $this->listerVente();
    } 
}
public function showApproDetails():void {
    $this->renderView("appros/lister", [
        "appros" => $this->approModel->findAll(),
        "fournisseurs" =>$this->fournisseurModel->findAll()
    ]);

    
      
}

public function listerVente():void {
    $this->renderView("appros/lister", [
        "appros" => $this->approModel->findAll(),
        "fournisseurs" =>$this->fournisseurModel->findAll()
    ]);

    
      
}

public function FilterVente(): void {
    $date = $_POST['date'] ?? '';
    $fournisseur = $_POST['fournisseur'] ?? 'All';

    if ($fournisseur == 'All') {
        $this->renderView("appros/lister", [
            "appros" => $this->approModel->findAll(),
            "fournisseurs" => $this->fournisseurModel->findAll()
        ]);
    } else {
        $this->renderView("appros/lister", [
            "appros" => $this->approModel->Filter($date, $fournisseur),
            "fournisseurs" => $this->fournisseurModel->findAll()
        ]);
    }
}






public function chargerFormulaire(): void
{
        $this->renderView("appros/form", [
            'fournisseurs'=>$this->fournisseurModel->findAll(),
            'articles'=>$this->articleModel->findAll(),

        ], );
}


public function ajouterArticleVenteDansAppro(array $data): void {

    if(Session::get("panier")==false){
        $panier=new PanierModel();
    }else{
        $panier=Session::get("panier");
    }
    $panier->addArticle($this->articleModel->findById($data["article_Id"]),$data["fournisseur_Id"],$data["qteAppro"]);
    Session::add("panier",$panier);
    $this->redirectToRoute("controller=appro&action=form-appro");
    
    
}

// public function ajouterAppro():void {
//     $panier=Session::get("panier");
//     $this->approModel->save($panier);
//     $this->redirectToRoute("controller=appro&action=form-appro");

    
// }



public function ajouterAppro(): void {
    $panier = Session::get("panier");
    if ($panier) {
        $approId = $this->approModel->save($panier);
        if ($approId !== 0) {
            Session::remove("panier");
            $this->redirectToRoute("?controller=appro&action=form-appro");
        } 
}
}




}