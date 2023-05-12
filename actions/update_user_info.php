<?php
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/client.class.php');

session_start();

$file = $_FILES['profile-input']['name'];

if ($file != "") {
    $path = pathinfo($file);
    $extension = $path['extension'];
    $dir = __DIR__ . "/../images/";
    $db = getDatabaseConnection();
    $filename = Client::getUserId($db, $_SESSION['username']);
    $temp = $_FILES['profile-input']['tmp_name'];
    $name = $dir . $filename . '.' . $extension;


    // delete file with same name
    $existing_files = glob($dir. $filename . ".*");
    foreach ($existing_files as $existing_file) unlink($existing_file);
      
    move_uploaded_file($temp, $name);

    header("Location: /pages/edit_profile.php");
}

//$db = getDatabaseConnection();

/*$name = $_POST['name'];
$username = $_SESSION['username'];
$email = $_POST['email'];

echo $_POST['name'];*/
//$id = Client::getUserId($db, $_SESSION['username']);
//$stmt = $db->prepare('UPDATE Client SET name=?, email=?, username=? WHERE userId=?');
//$stmt->execute(array($name, $email, $username, $id));


//$response = array('success' => true);
//header('Content-Type: application/json');
//echo json_encode($response);