<?php
session_start();

require_once(__DIR__ . '/../database/users.php');

$errors = validateLogin();

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['login_values'] = retrieveLoginFormFields();
    header('Location: /pages/login.php');
    exit;
}

if (userExists($_POST['username'], $_POST['password'])){
    $_SESSION['username'] = $_POST['username'];
    header('Location: /');
} else {
    $errors['undefined'] = 'Invalid username/password.';
    $_SESSION['errors'] = $errors;
    $_SESSION['login_values'] = retrieveLoginFormFields();
    header('Location: /pages/login.php');
}

?>