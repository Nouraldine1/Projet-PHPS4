<?php 

class TypeModel{
public function findAll(): array{
    // Database connection details
    $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=database';
    $username = 'root';
    $password = '';

    try {
        $dbh = new PDO($dsn, $username, $password);
        $sql = "SELECT *
                FROM type
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


public function save(string $nomtype): bool {
    $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=database';
    $username = 'root';
    $password = '';

    try {
        $dbh = new PDO($dsn, $username, $password);
        $sql = "INSERT INTO type (nomtype) VALUES (:nomtype)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':nomtype', $nomtype);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return false;
    }
}


public function typeExiste(string $nomtype): bool {
    $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=database';
    $username = 'root';
    $password = '';

    try {
        $dbh = new PDO($dsn, $username, $password);
        $sql = "SELECT COUNT(*) FROM type WHERE nomtype = :nomtype";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':nomtype', $nomtype);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return false;
    }
}

}
?>