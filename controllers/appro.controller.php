<?php
require_once("../model/fournisseur.model.php");
require_once("../model/panier.model.php");
require_once("../model/article.model.php");
require_once("../model/appro.model.php");
require_once("../core/controller.php");
class ApproController extends Controller{
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
        $this->approModel = new ApproModel();
        $this->load();
    }
public function load() {
    if (isset($_REQUEST['action'])) {
        if ($_REQUEST['action'] == "lister-appro") {
            unset($_POST['action']);
            unset($_POST['controller']);
            $this->listerAppro();
        } elseif ($_REQUEST['action'] == "form-appro") {
            $this->chargerFormulaire();
        }elseif ($_REQUEST['action'] == "add-article") {
            $this-> ajouterArticleDansAppro($_POST);
        }elseif ($_REQUEST['action'] == "add-appro") {
            $this-> ajouterAppro();
        }elseif ($_REQUEST['action'] == "filtrer-appro") {
            $this->FilterAppro();
        }elseif ($_REQUEST['action'] == "show-appro-details") {
            $approId = $_GET['id'];
            $this->showApproDetails($approId);
        }
        
    } else { 
        $this->listerAppro();
    } 
}
public function showApproDetails():void {
    $this->renderView("appros/lister", [
        "appros" => $this->approModel->findAll(),
        "fournisseurs" =>$this->fournisseurModel->findAll()
    ]);

    
      
}

public function listerAppro():void {
    $this->renderView("appros/lister", [
        "appros" => $this->approModel->findAll(),
        "fournisseurs" =>$this->fournisseurModel->findAll()
    ]);

    
      
}

public function FilterAppro(): void {
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


public function ajouterArticleDansAppro(array $data): void {

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