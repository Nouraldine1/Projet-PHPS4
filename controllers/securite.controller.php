<?php  
require_once("../model/article.model.php");
require_once("../model/user.model.php");
require_once("../model/type.model.php");
require_once("../core/Controller.php");
class SecuriteController extends controller{

    private UserModel $userModel;
    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->load();
    }

}