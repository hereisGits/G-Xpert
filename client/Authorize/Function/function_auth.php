<?php
function checkRequiredField($value) {
    return isset($value) && !empty(trim($value));
}

function usernameValidate($username) {
    if (strlen($username) < 4 || strlen($username) > 8) {
        return false;
    }
    if (!preg_match('/^[A-Za-z][A-Za-z0-9_]*$/', $username)) {
        return false;
    }
    return true;
}

function emailValidate($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function passValidate($password) {
    if (strlen($password) <= 6) {
        return false;
    }
    if (!preg_match('/[a-zA-Z]/', $password)) {  
        return false;
    }
    if (!preg_match('/\d/', $password)) {        
        return false;
    }
    if (!preg_match('/[@$!%*?&_]/', $password)) {
        return false;
    }
    return true;
}


function printErrorMsg($error, $field) {
    return array_key_exists($field, $error) ? "<span class='error'>{$error[$field]}</span>" : "";
}