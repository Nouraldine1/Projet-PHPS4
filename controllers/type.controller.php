<?php  
if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == "lister-type") {
        listertype();
    } elseif ($_REQUEST['action'] == "add-type") {
        ajoutertype();
        listertype();
    }
} else {
    listertype();
}


function listertype(): void
{
    /* Au prealable, avant de charger la vue, il faudra faire appel au model 
        pour chercher les donnees de la table article. */
    require_once("../model/type.model.php");
    $types = findAllTypes();
    // Chargement de la vue     
    //var_dump($articles);
    require_once("../views/type/lister.html.php");

}


// article.controller.php

function ajoutertype(): void {
    if (isset($_POST['new-type']) && !empty($_POST['new-type'])) {
        require_once("../model/type.model.php");
        $nomtype = $_POST['new-type'];

        if (typeExiste($nomtype)) {
            echo "La catégorie existe déjà.";
        } else {
            if (inserttype($nomtype)) {
                header("Location: " . WEBROOT . "?action=lister-type");
                exit();
            } else {
                echo "Erreur lors de l'ajout de la catégorie.";
            }
        }
    } else {
        echo "Le nom de la catégorie est obligatoire.";
    }
}

?>