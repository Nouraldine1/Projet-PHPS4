<?Php
require_once("../core/Model.php");
class  UserModel extends Model{
    public function __construct() {
        $this->ouvrirConnexion();
        $this->table="user";
    }

    
    public function findByLoginAndPassword(string $login, string $password): array|false {
        $stmt = $this->pdo->prepare("SELECT * 
            FROM $this->table u 
            JOIN role r ON u.role_Id = r.id 
            WHERE u.login = :login AND u.password = :password");
        $stmt->execute(['login' => $login, 'password' => $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function createUser(string $nomComplet, string $login, string $password, int $role, string $tel, string $adresse): bool {
        $sql = "INSERT INTO $this->table (nomComplet, login, password, role_Id, tel, adresse) 
                VALUES (:nomComplet, :login, :password, :role_Id, :tel, :adresse)";
        $params = [
            'nomComplet' => $nomComplet,
            'login' => $login,
            'password' => $password,
            'role_Id' => $role,
            'tel' => $tel,
            'adresse' => $adresse
        ];
        return $this->executeUpdate($sql, $params);
    }

    public function findAllWithRoles(): array {
        $sql = "SELECT u.*, r.name AS role FROM $this->table u 
                JOIN role r ON u.role_id = r.id";
        return $this->executeSelect($sql);
    }

    public function findByRole($roleId): array {
        $sql = "SELECT u.*, r.name AS role FROM $this->table u 
                JOIN role r ON u.role_id = r.id 
                WHERE r.id = :roleId";
        return $this->executeSelect($sql, ['roleId' => $roleId]);
    }

    public function findAllRoles(): array {
        return $this->executeSelect("SELECT * FROM role");
    }
}



?>