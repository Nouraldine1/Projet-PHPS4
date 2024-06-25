<?php
class Session {
    public static function ouvrir(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
}
// Ajouter Donne

public static function add(string $key,mixed $data){
    
    $_SESSION[$key]=$data;
}

// Detruire donne


public static function remove(string $key):bool{

    if(isset($_SESSION[$key])){
        unset($_SESSION[$key]);
        return true;
    }
    return false;
}

//Recuperer une valeur dans la Session

public static function get(string $key) {
    return $_SESSION[$key] ?? null;
}

public static function fermer(){
    unset($_SESSION["userConnect"]);
        session_destroy();
}


}

?>