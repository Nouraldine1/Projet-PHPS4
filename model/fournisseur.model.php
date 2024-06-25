<?php 
require_once("../core/Model.php");

class FournisseurModel extends Model {
    public function __construct() {
        $this->ouvrirConnexion();
        $this->table="fournisseur";
    }

}
?>
