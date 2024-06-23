<?php
function findAllCategorie(): array{
    // Database connection details
    $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=database';
    $username = 'root';
    $password = '';

    try {
        $dbh = new PDO($dsn, $username, $password);
        $sql = "SELECT *
                FROM Categorie
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

// article.model.php

function insertCategorie(string $nomCategorie): bool {
    $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=database';
    $username = 'root';
    $password = '';

    try {
        $dbh = new PDO($dsn, $username, $password);
        $sql = "INSERT INTO Categorie (nomCategorie) VALUES (:nomCategorie)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':nomCategorie', $nomCategorie);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return false;
    }
}


function categorieExiste(string $nomCategorie): bool {
    $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=database';
    $username = 'root';
    $password = '';

    try {
        $dbh = new PDO($dsn, $username, $password);
        $sql = "SELECT COUNT(*) FROM Categorie WHERE nomCategorie = :nomCategorie";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':nomCategorie', $nomCategorie);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return false;
    }
}

?>