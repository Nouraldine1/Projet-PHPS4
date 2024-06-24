<?Php
require_once("../core/Model.php");
class  UserModel extends Model{
    public function __construct() {
        $this->ouvrirConnexion();
        $this->table="user";
    }

    public function findByLoginAndPassword( string $login,string $password): array|false
    {
      return  $this->executeSelect("SELECT * 
                FROM $this->table  u,role r where u.role_Id=r.id and u.login like '$login' and u.pawssword like ' $password'");
    }


}
?>