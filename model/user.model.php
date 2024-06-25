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
    


}
?>