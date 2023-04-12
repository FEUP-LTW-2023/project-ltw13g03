<?php
  session_start();

  require_once(__DIR__ . '/../database/users.php');

  if (userExists($_POST['username'], $_POST['password'])){
    $_SESSION['username'] = $_POST['username'];
    header('Location: /');
  } else header('Location: /pages/login.php')

?>