<?php

require_once ("../model/categorie.model.php");
require_once ("../core/Model.php");

class ArticleVenteModel extends Model
{

    public function __construct()
    {
        $this->ouvrirConnexion();
        $this->table="article";
    }

    public function findAll(): array
    {
        return $this->executeSelect(
            "SELECT a.*, c.nomCategorie, t.nomType
             FROM article a
             INNER JOIN Categorie c ON a.categorie_id = c.id
             INNER JOIN Type t ON a.type_id = t.id"
        );
    }
    
    



    public function save(string $libelle, string $prix, int $qteStock, int $categorie_id, int $type_id): bool {
        $sql = "INSERT INTO article (libelle, prixAppro, qteStock, categorie_id, type_id) 
                VALUES (:libelle, :prix, :qteStock, :categorie_id, :type_id)";
        $params = [
            ':libelle' => $libelle,
            ':prix' => $prix,
            ':qteStock' => $qteStock,
            ':categorie_id' => $categorie_id,
            ':type_id' => $type_id
        ];
        
        $rowCount = $this->executeUpdate($sql, $params);
        return $rowCount > 0;
    }


    public function articleVenteExiste(string $libelle): bool
    {
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



// public function findById(int $id): bool
// {
//     return $this->executeSelect(
//         "SELECT  a.* FROM  this->table where id=$id");
// }




}



?>