<?php
require_once("../core/Model.php");
class  CategorieModel extends Model{
    public function __construct() {
        $this->ouvrirConnexion();
    }


public function findAll(): array
{

  return  $this->executeSelect("SELECT *
                FROM Categorie
                ");
}


public function save(string $nomCategorie): bool {
    $sql = "INSERT INTO `Categorie` (`nomCategorie`) VALUES (:nomCategorie)";
    $params = [':nomCategorie' => $nomCategorie];
    return $this->executeUpdate($sql, $params);
}

public function categorieExiste(string $nomCategorie): bool {
    $sql = "SELECT COUNT(*) as count FROM `Categorie` WHERE `nomCategorie` = :nomCategorie";
    $params = [':nomCategorie' => $nomCategorie];
    $result = $this->executeSelect($sql, $params);
    return $result[0]['count'] > 0;
}
}
?>