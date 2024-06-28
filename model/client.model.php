<?php 
require_once("../core/Model.php");

class ClientModel extends Model {
    public function __construct() {
        $this->ouvrirConnexion();
        $this->table="client";
    }


}
?>
