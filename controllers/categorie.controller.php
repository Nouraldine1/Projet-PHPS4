<?php  
if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == "lister-categorie") {
        listerCategorie();
    } elseif ($_REQUEST['action'] == "add-categorie") {
        ajouterCategorie();
        listerCategorie();
    }
} else {
    listerCategorie();
}


function listerCategorie(): void
{
    /* Au prealable, avant de charger la vue, il faudra faire appel au model 
        pour chercher les donnees de la table article. */
    require_once("../model/categorie.model.php");
    $categories = findAllCategorie();
    // Chargement de la vue     
    //var_dump($articles);
    require_once("../views/categorie/lister.html.php");

}


// article.controller.php

function ajouterCategorie(): void {
    if (isset($_POST['new-categorie']) && !empty($_POST['new-categorie'])) {
        require_once("../model/article.model.php");
        $nomCategorie = $_POST['new-categorie'];

        if (categorieExiste($nomCategorie)) {
            echo "La catégorie existe déjà.";
        } else {
            if (insertCategorie($nomCategorie)) {
                header("Location: " . WEBROOT . "?action=lister-categorie");
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