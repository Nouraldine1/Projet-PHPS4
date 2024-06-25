<?php

function add_class_invalid(string $fieldName): void {
    echo isset(Session::get("errors")[$fieldName]) ? "is-invalid" : "";
}

function has_role(string $roleName): void {
    echo !Autorisation::hasRole($roleName) ? "hidden" : "";
}


function dd(mixed $data): void {
    dump($data);
    die;
}

function dump(mixed $data): void {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}
?>