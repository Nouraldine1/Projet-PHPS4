<?php
class Model {
    protected $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=database';
    protected $username = 'root';
    protected $password = '';
    protected PDO|null $pdo = null;
    protected string $table;
 
    public function ouvrirConnexion():void{
        try {
            if ($this->pdo == null) {
                $this->pdo = new PDO($this->dsn, $this->username, $this->password);
            }
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function fermerConnexion():void{
            if ($this->pdo !=null) {
                $this->pdo = null;
            }
    }
    public function executeUpdate(string $sql, array $params = []): bool {
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
            return false;
        }
    }

    public function executeSelect(string $sql, array $params = []): array|bool {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
            return [];
        }
    }
    public function findAll(): array
{
  return  $this->executeSelect("SELECT * FROM $this->table");
}

public function findById(int $id): array|bool
{
    $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
    $params = [':id' => $id];
    $result = $this->executeSelect($sql, $params);

    if ($result === false || count($result) === 0) {
        return false;
    }

    return $result[0];
}




}
 


 
 
?>