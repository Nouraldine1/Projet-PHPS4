<?php  
require_once("../model/article.model.php");
require_once("../model/categorie.model.php");
require_once("../model/type.model.php");
require_once("../core/Controller.php");
class TypeController extends controller{
    private TypeModel $typeModel;
    private  array    $datas ;

    public function __construct() {
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("?controller=securite&action=form-connexion");
        }
        parent::__construct();
        $this->typeModel = new TypeModel();
        $this->load();
    }
public function load()
{
    if (isset($_REQUEST['action'])) {
        if ($_REQUEST['action'] == "lister-type") {
            unset($_POST['action']);
            unset($_POST['controller']);
           $this->listertype();
        } elseif ($_REQUEST['action'] == "add-type") {
            $this->ajoutertype();
            $this->listertype();
        }
    } else {
        $this->listertype();
    }
}


public function listertype(): void
{
    $this->renderView("type/lister", [
        'types' => $this->typeModel->findAll() 
    ], );;  

}

public function ajoutertype(): void {
    Session::ouvrir();
    $newType = $_POST['new-type'] ?? null;
    var_dump($newType); // Vérifiez la valeur de newType

    if ($newType !== null) {
        Validator::isEmpty($newType, "new-Type", "Le champ est obligatoire");
        if (Validator::isValide()) {
            if ($this->typeModel->typeExiste($newType)) {
                Session::add("errors", ["new-Type" => "Le type existe déjà."]);
            } else {
                $result = $this->typeModel->save($newType);
                if ($result) {
                    header("Location: " . WEBROOT . "?controller=type&action=lister-type");
                    exit();
                } else {
                    Session::add("errors", ["new-Type" => "Erreur lors de l'ajout du type."]);
                }
            }
        } else {
            Session::add("errors", Validator::getErrors());
        }
    } else {
        Session::add("errors", ["new-Type" => "Le champ est obligatoire"]);
    }

    header("Location: " . WEBROOT . "?controller=type&action=lister-type");
    exit();
}


}




?>