<?php  

class Autorisation{
    // isconnect
    public static function isConnect(): bool {
        return Session::get("userConnect") == false;  // Assurez-vous de vérifier si userConnect n'est pas null
    }
    

    public static function hasRole(string $roleName):bool{
        $userConnect=Session::get("userConnect");
      if ($userConnect){
       return $userConnect["name"]==$roleName;

      }return false;
    }

 //hasRole
 
}
?>