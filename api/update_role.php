<?php
    declare(strict_types = 1);

    # check session
    session_start();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/client.class.php');

    $response = NULL;
    if(!isset($_SESSION['username'])){
        header("Location: /pages/login.php");
    } else {
        $db = getDatabaseConnection();
        $client = Client::getUser($db, $_SESSION['username']);
        if ($client->isAdmin) {
            $roles = Client::updateUserRole($db, $_GET['username'], (bool) $_GET['isAgent'], (bool) $_GET['isAdmin']);
        }
        $response = Client::getUser($db, $_GET['username']);
    }

    echo json_encode($response);
?>