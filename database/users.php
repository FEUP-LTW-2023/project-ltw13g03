<?php

require_once(__DIR__ . '/../database/connection.php');

function userExists($username, $password){
    $db = getDatabaseConnection();

    $stmt = $db->prepare('SELECT * FROM Client WHERE username=? AND password=?');
    $stmt->execute(array($username, sha1($password)));

    if ($stmt->fetch()) return true;
    return false;
}

?>