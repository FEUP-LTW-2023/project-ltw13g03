<?php
  session_start();

  require_once(__DIR__ . '/../database/users.php');
  require_once(__DIR__ . '/../database/client.class.php');
  
  if ($_POST['password1'] != $_POST['password2'])
    header('Location: /pages/register.php');
  else {
    if (createAccount($_POST['name'], $_POST['username'], $_POST['email'], $_POST['password1'])){
        $_SESSION['username'] = $_POST['username'];

        $file = $_FILES['profile-input']['name'];

        if ($file != "") {
          $path = pathinfo($file);
          $extension = $path['extension'];
          $dir = __DIR__ . "/../images/";
          $filename = $_POST['username']; // change to userId
          $temp = $_FILES['profile-input']['tmp_name'];
          $name = $dir . $filename . '.' . $extension;


          move_uploaded_file($temp, $name);
        }

        header('Location: /');
      } else header('Location: /pages/register.php');
  }

?>