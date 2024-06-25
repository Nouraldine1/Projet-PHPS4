<?php class Validator {
    public static array $errors = [];

    public static function isValide(): bool {
        return count(self::$errors) === 0;
    }
    public static function add(string $key,mixed $data){
    
        $_SESSION[$key]=$data;
    }

    public static function isEmpty(?string $valueField, string $nameField, string $message = "Le champ est obligatoire"):bool {
        if (empty($valueField)) {
            self::$errors[$nameField] = $message;
            return true;
        } return false;
    }

    public static function getErrors(): array {
        return self::$errors;
    }
    public static function isEmail(?string $valueField, string $nameField, string $message = "Le champ est obligatoire"){
        if (!filter_var($valueField, FILTER_VALIDATE_EMAIL)) {
            self::$errors[$nameField] = $message;
       
    }   

    }

    }
?>