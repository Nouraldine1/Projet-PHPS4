<?php  
require_once("../model/article.model.php");
require_once("../model/categorie.model.php");
require_once("../model/type.model.php");
require_once("../core/Controller.php");
class TypeController extends controller{
    private TypeModel $typeModel;

    public function __construct() {
        parent::__construct();
        $this->typeModel = new TypeModel();
        $this->load();
    }
public function load()
{
    if (isset($_REQUEST['action'])) {
        if ($_REQUEST['action'] == "lister-type") {
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


// article.controller.php

public function ajoutertype(): void {
    if (isset($_POST['new-type']) && !empty($_POST['new-type'])) {
        require_once("../model/type.model.php");
        $nomtype = $_POST['new-type'];

        if ($this->typeModel->typeExiste($nomtype)) {
            echo "La catégorie existe déjà.";
        } else {
            if ($this->typeModel->save($nomtype)) {
                header("Location: " . WEBROOT . "?controller=type&action=lister-type");
                exit();
            } else {
                echo "Erreur lors de l'ajout de la catégorie.";
            }
        }
    } else {
        echo "Le nom de la catégorie est obligatoire.";
    }
}
}
?>