<?php class Validator {
    public static array $errors = [];

    public static function isValide(): bool {
        return count(self::$errors) === 0;
    }

    public static function isEmpty(?string $valueField, string $nameField, string $message = "Le champ est obligatoire") {
        if (empty($valueField)) {
            self::$errors[$nameField] = $message;
        }
    }

    public static function getErrors(): array {
        return self::$errors;
    }
}



?>