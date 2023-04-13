<?php
  session_start();

  require_once(__DIR__ . '/../database/users.php');
  
  if ($_POST['password1'] != $_POST['password2'])
    header('Location: /pages/register.php');
  else {
    if (createAccount($_POST['name'], $_POST['username'], $_POST['email'], $_POST['password1'])){
        $_SESSION['username'] = $_POST['username'];
        header('Location: /');
      } else header('Location: /pages/register.php');
  }

?>