<?php

require_once(__DIR__ . '/../database/connection.db.php');

function userExists($username, $password){
    $db = getDatabaseConnection();

    $stmt = $db->prepare('SELECT * FROM Client WHERE username=?');
    $stmt->execute(array($username));
    $client = $stmt->fetch();

    if ($client === false)
        return false;

    return (password_verify($password, $client['password']));
}

function createAccount($name, $username, $email, $password): bool {
    $db = getDatabaseConnection();

    $stmt = $db->prepare('SELECT * FROM Client WHERE username=?');
    $stmt->execute(array($username));

    if ($stmt->fetch()) return false;
    
    $stmt = $db->prepare('INSERT INTO Client (name, username, email, password) VALUES (?, ?, ?, ?)');
    $stmt->execute(array($name, $username, $email, password_hash($password, PASSWORD_BCRYPT)));

    $id = Client::getUserId($db, $username);
    $stmt = $db->prepare('INSERT INTO Agent (isAgent, userId) VALUES (false, ?)');
    $stmt->execute(array($id));

    $stmt = $db->prepare('INSERT INTO Admin (isAdmin, userId) VALUES (false, ?)');
    $stmt->execute(array($id));

    return true;
}

function getUserInfo($username) {
    $db = getDatabaseConnection();

    $stmt = $db->prepare('SELECT username, name, email, isAgent, isAdmin FROM Client LEFT JOIN Agent using(userId) LEFT JOIN Admin using(userId) WHERE username=?');
    $stmt->execute(array($username));
    return $stmt->fetch();
}

?>