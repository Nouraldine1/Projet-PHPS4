<?php
require_once("../core/Model.php");
class roleModel extends Model{
    public function __construct() {
        $this->ouvrirConnexion();
        $this->table="role";
    }


    public function findAllWithRoles(): array {
        $sql = "SELECT u.*, r.name AS role FROM $this->table u 
                JOIN role r ON u.role_Id = r.id";
        return $this->executeSelect($sql);
    }

    public function findByRole($roleId): array {
        $sql = "SELECT u.*, r.name AS role FROM $this->table u 
                JOIN role r ON u.role_Id = r.id 
                WHERE r.id = :role_Id";
        return $this->executeSelect($sql, ['role_Id' => $roleId]);
    }

    // public function findAll(): array {
    //     return $this->executeSelect("SELECT * FROM role");
    // }

}
?>