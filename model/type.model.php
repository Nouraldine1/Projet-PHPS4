<?php 
require_once("../core/Model.php");

class TypeModel extends Model {
    public function __construct() {
        $this->ouvrirConnexion();
    }

    public function findAll(): array {
        return $this->executeSelect("SELECT * FROM type");
    }

    public function save(string $nomtype): bool {
        $sql = "INSERT INTO type (nomtype) VALUES (:nomtype)";
        $params = [':nomtype' => $nomtype];
        return $this->executeUpdate($sql, $params);
    }

    public function typeExiste(string $nomtype): bool {
        $sql = "SELECT COUNT(*) as count FROM type WHERE nomtype = :nomtype";
        $params = [':nomtype' => $nomtype];
        $result = $this->executeSelect($sql, $params);
        return $result[0]['count'] > 0;
    }
}
?>
