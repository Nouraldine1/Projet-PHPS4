<?php  
require_once("../model/article.model.php");
require_once("../model/user.model.php");
require_once("../model/type.model.php");
require_once("../core/Controller.php");
require_once("../core/Session.php");

class SecuriteController extends Controller {

    private UserModel $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->layout = "connexion";
        $this->load();
    }

    public function load() {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "connexion") {
                unset($_POST['action']);
                unset($_POST['controller']);
                $this->connexion($_POST);
            } elseif ($_REQUEST['action'] == "form-connexion") {
                $this->showFormConnexion();
            }elseif($_REQUEST['action'] == "logout"){
                 $this->logout();
            }
        } else {
            $this->showFormConnexion();
            parent::renderView("securite/form");
        }
    }

    private function logout(): void {
        Session::fermer();
        $this->redirectToRoute("?controller=securite&action=form-connexion");
    }
    private function showFormConnexion(): void {
        parent::renderView("securite/form");
    }

    // private function connexion(array $data): void {
    //     // Vérifiez si les clés 'login' et 'password' existent dans $data
    //     if (isset($data["login"]) && isset($data["password"])) {
    //         if (!Validator::isEmpty($data["login"], "login", "Mail incorrect")) {
    //             Validator::isEmail($data["login"], "login", "Mail incorrect");
    //         }
    //         Validator::isEmpty($data["password"], "password", "Mot de passe incorrect");
    //         if (Validator::isValide()) {
    //             // Utilisation de requêtes paramétrées pour éviter les injections SQL
    //             $userConnect = $this->userModel->findByLoginAndPassword($data["login"], $data["password"]);
    //             if ($userConnect) {
    //                 Session::add("userConnect", $userConnect);
    //                 // droit d acces          
    //                 $this->redirectToRoute("?controller=article&action=lister-article");
    //             } else {
    //                 Validator::add("error_connection", "Utilisateur introuvable");
    //                 Session::add("errors", Validator::$errors);
    //                 $this->redirectToRoute("?controller=securite&action=form-connexion");
    //             }
    //         } else {
    //             Session::add("errors", Validator::$errors);
    //             $this->redirectToRoute("?controller=securite&action=form-connexion");
    //         }
    //     } else {
    //         // Ajoutez des messages d'erreur si les clés 'login' et 'password' ne sont pas définies
    //         if (!isset($data["login"])) {
    //             Validator::add("login", "Le champ login est obligatoire");
    //         }
    //         if (!isset($data["password"])) {
    //             Validator::add("password", "Le champ mot de passe est obligatoire");
    //         }
    //         Session::add("errors", Validator::$errors);
    //         $this->redirectToRoute("?controller=securite&action=form-connexion");
    //     }
    // }

    private function connexion(array $data): void {
        if (isset($data["login"]) && isset($data["password"])) {
            if (!Validator::isEmpty($data["login"], "login", "Mail incorrect")) {
                Validator::isEmail($data["login"], "login", "Mail incorrect");
            }
            Validator::isEmpty($data["password"], "password", "Mot de passe incorrect");
            if (Validator::isValide()) {
                $userConnect = $this->userModel->findByLoginAndPassword($data["login"], $data["password"]);
                if ($userConnect) {
                    Session::add("userConnect", $userConnect);
                    $roleId = $userConnect['role_Id'];
                    if ($roleId == 1) { // RS
                        $this->redirectToRoute("?controller=appro&action=lister-appro");
                    } elseif ($roleId == 3) { // Gestionnaire
                        $this->redirectToRoute("?controller=article&action=lister-article");
                    } elseif ($roleId == 4) { // RP
                        $this->redirectToRoute("?controller=production&action=lister-production");
                    } elseif ($roleId == 5) { // Vendeur
                        $this->redirectToRoute("?controller=vente&action=lister-vente");
                    } else {
                        $this->redirectToRoute("?controller=article&action=lister-article");
                    }
                } else {
                    Validator::add("error_connection", "Utilisateur introuvable");
                    Session::add("errors", Validator::$errors);
                    $this->redirectToRoute("?controller=securite&action=form-connexion");
                }
            } else {
                Session::add("errors", Validator::$errors);
                $this->redirectToRoute("?controller=securite&action=form-connexion");
            }
        } else {
            if (!isset($data["login"])) {
                Validator::add("login", "Le champ login est obligatoire");
            }
            if (!isset($data["password"])) {
                Validator::add("password", "Le champ mot de passe est obligatoire");
            }
            Session::add("errors", Validator::$errors);
            $this->redirectToRoute("?controller=securite&action=form-connexion");
        }
    }  
}

?>