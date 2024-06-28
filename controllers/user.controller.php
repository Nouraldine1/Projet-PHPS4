<?php  
require_once("../model/article.model.php");
require_once("../model/categorie.model.php");
require_once("../model/type.model.php");
require_once("../model/user.model.php");
require_once("../model/role.model.php");
require_once("../core/Controller.php");
class UserController extends controller{
    private UserModel $userModel;
    private RoleModel $roleModel;
    private  array    $datas ;

    public function __construct() {
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("?controller=securite&action=form-connexion");
        }
        parent::__construct();
        $this-> userModel = new  UserModel();
        $this->roleModel = new RoleModel();
        $this->load();
    }
public function load()
{
    if (isset($_REQUEST['action'])) {
        if ($_REQUEST['action'] == "lister-user") {
            unset($_POST['action']);
            unset($_POST['controller']);
           $this->listerUser();
        } elseif ($_REQUEST['action'] == "add-user") {
            $this->ajouterUser();
        } elseif ($_REQUEST['action'] == "form-add-user") {
            $this->showAddUserForm();
        }
    } else {
        $this->listerUser();
    }
}

public function listerUser(): void {
    $role = $_POST['role'] ?? 'All';
    $users = ($role === 'All') ? $this->userModel->findAllWithRoles() : $this->userModel->findByRole($role);

    $this->renderView("user/lister", [
        'users' => $users,
        'roles' => $this->userModel->findAllRoles()
    ]);
}


// public function ajouterUser(): void {
//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         $nomComplet = $_POST['nomComplet'];
//         $login = $_POST['login'];
//         $password = $_POST['password'];
//         $role = $_POST['role'];
//         $tel = $_POST['tel'];
//         $adresse = $_POST['adresse'];
        
//         $this->userModel->createUser($nomComplet, $login, $password, $role, $tel, $adresse);
//         $this->listerUser();
//     }
// }

public function showAddUserForm(): void {


    $this->renderView("user/form",[
        'roles' => $this->userModel->findAllRoles()
    ]);
}

public function ajouterUser() {
    $errors = [];
    // dd($_POST) ;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nomComplet = trim($_POST['nomComplet']);
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);
        $role = $_POST['role'];
        $tel = trim($_POST['tel']);
        $adresse = trim($_POST['adresse']);

        if (empty($nomComplet)) {
            $errors['nomComplet'] = "Le nom complet est requis.";
        }

        if (empty($login)) {
            $errors['login'] = "Le login est requis.";
        }

        if (empty($password)) {
            $errors['password'] = "Le mot de passe est requis.";
        }

        if (empty($role)) {
            $errors['role'] = "Le rôle est requis.";
        }

        if (empty($tel)) {
            $errors['tel'] = "Le téléphone est requis.";
        }

        if (empty($adresse)) {
            $errors['adresse'] = "L'adresse est requise.";
        }

        if (count($errors) === 0) {
            $this->userModel->createUser($nomComplet, $login, $password, $role, $tel, $adresse);
            $this->listerUser();
        } else {
            Session::add('errors', $errors);
            header('Location: ' . WEBROOT . '?controller=user&action=form-add-user');
            exit();
        }
    }
}






}




?>

