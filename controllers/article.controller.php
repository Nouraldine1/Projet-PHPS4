<?php

require_once("../model/article.model.php");

if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == "lister-article") {
        listerArticle();
    } elseif ($_REQUEST['action'] == "form-article") {
        chargerFormulaire();
    }elseif ($_REQUEST['action'] == "add-article") {
        ajouterArticle();
    }elseif ($_REQUEST['action'] == "Fermer-form") {
        listerArticle();
    }
} else {
    listerArticle();
}

function listerArticle(): void
{
    /* Au prealable, avant de charger la vue, il faudra faire appel au model 
        pour chercher les donnees de la table article. */
    require_once("../model/article.model.php");
    $articles = findAll();
    // Chargement de la vue     
    //var_dump($articles);
    require_once("../views/Articles/lister.html.php");

}
function chargerFormulaire(): void
{
    require_once("../model/article.model.php");
    $types = findAllType();
    $categories = findAllCategorie();


    require_once("../views/Articles/form.html.php");
}


function ajouterArticle(): void {
    // Validation des donnees du formulaire
    $libelle = $_POST['libelle'];
    $prix = $_POST['prix'];
    $qteStock = $_POST['qteStock'];
    $categorie_id = $_POST['categorie'];
    $type_id = $_POST['type'];

    // Verification des valeurs
    if (empty($libelle) || $categorie_id <= 0 || $type_id <= 0) {
        echo "Erreur : tous les champs sont obligatoires et doivent contenir des valeurs valides,reessayer";
        chargerFormulaire();
        return;
    }

    // Verification si le libelle est unique
    require_once("../model/article.model.php");
    if (articleExiste($libelle)) {
        echo "Erreur : Le libelle de l'article existe deja,reessayer";
        chargerFormulaire();
        return;
    }

    // Verification si les prix et la quantite sont positifs
    if ($prix <= 0 || $qteStock <= 0) {
        echo "Erreur : Le prix et la quantite doivent être des valeurs positives,reessayer";
        chargerFormulaire();
        return;
    }

    // Inserer l'article dans la base de donnees
    $result = insertArticle($libelle, $prix,  $qteStock, $categorie_id, $type_id);

    if ($result) {
        header("Location: " . WEBROOT . "?action=lister-article");
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'article.";
    }
}

