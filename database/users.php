<?php

require_once(__DIR__ . '/../database/connection.php');

function userExists($username, $password){
    $db = getDatabaseConnection();

    $stmt = $db->prepare('SELECT * FROM Client WHERE username=? AND password=?');
    $stmt->execute(array($username, sha1($password)));

    if ($stmt->fetch()){
        return true;
    }
    return false;
}

function createAccount($name, $username, $email, $password){
    $db = getDatabaseConnection();

    $stmt = $db->prepare('SELECT * FROM Client WHERE username=?');
    $stmt->execute(array($username));

    if ($stmt->fetch()) return false;
    
    $stmt = $db->prepare('INSERT INTO Client (name, username, email, password) VALUES (?, ?, ?, ?)');
    $stmt->execute(array($name, $username, $email, sha1($password)));

    return true;
}

function getUserInfo($username): array{
    $db = getDatabaseConnection();

    $stmt = $db->prepare('SELECT * FROM Client WHERE username=?');
    $stmt->execute(array($username));
    return $stmt->fetch();
}

?>