<?php

require_once("../model/categorie.model.php");
function findAll(): array {

    $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=database';
    $username = 'root';
    $password = '';

    try {
        $dbh = new PDO($dsn, $username, $password);
        $sql = "SELECT * 
                FROM article
                INNER JOIN Categorie ON article.categorie_id = Categorie.id
                INNER JOIN Type ON article.type_id = Type.id
                ";
        $stm = $dbh->query($sql);
        // fetch all rows into array, by default PDO::FETCH_BOTH is used
        // $rows = $stm->fetchAll(PDO::FETCH_NUM);
        return $stm->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        // Handle the error
        echo 'Connection failed: ' . $e->getMessage();
    }
}

function findAllType(): array
{
    $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=database';
    $username = 'root';
    $password = '';

    try {
        $dbh = new PDO($dsn, $username, $password);
        $sql = "SELECT *
                FROM Type
                ";
        $stm = $dbh->query($sql);
        // fetch all rows into array, by default PDO::FETCH_BOTH is used
        // $rows = $stm->fetchAll(PDO::FETCH_NUM);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the error
        echo 'Connection failed: ' . $e->getMessage();
    }
}

function insertArticle(string $libelle, string $prix, int $qteStock, int $categorie_id, int $type_id): bool {
    $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=database';
    $username = 'root';
    $password = '';

    try {
        $dbh = new PDO($dsn, $username, $password);
        $sql = "INSERT INTO article (libelle, prixAppro, qteStock, categorie_id, type_id) 
                VALUES (:libelle, :prix, :qteStock, :categorie_id, :type_id)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':libelle', $libelle);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':qteStock', $qteStock);
        $stmt->bindParam(':categorie_id', $categorie_id);
        $stmt->bindParam(':type_id', $type_id);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return false;
    }
}

function articleExiste(string $libelle): bool {
    $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=database';
    $username = 'root';
    $password = '';

    try {
        $dbh = new PDO($dsn, $username, $password);
        $sql = "SELECT COUNT(*) AS total FROM article WHERE libelle = :libelle";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':libelle', $libelle);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] > 0;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return false;
    }
}






?>