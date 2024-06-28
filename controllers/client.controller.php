<?php  
require_once("../model/article.model.php");
require_once("../model/categorie.model.php");
require_once("../model/client.model.php");
require_once("../model/type.model.php");
require_once("../core/Controller.php");
class ClientController extends controller{
    private ClientModel $clientModel;
    private  array    $datas ;

    public function __construct() {
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("?controller=securite&action=form-connexion");
        }
        parent::__construct();
        $this->clientModel = new ClientModel();
        $this->load();
    }
public function load()
{
    if (isset($_REQUEST['action'])) {
        if ($_REQUEST['action'] == "lister-client") {
            unset($_POST['action']);
            unset($_POST['controller']);
           $this->listerClient();
        } 
    } else {
        $this->listerClient();
    }
}


public function listerClient(): void
{
    $this->renderView("type/lister", [
        'Client' => $this->clientModel->findAll() 
    ], );;  

}



}




?>