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
            Client::updateUserDepartments($db, $_GET['username'], $_GET['department'], true);
        }
        $response = Client::getUser($db, $_GET['username']);
    }

    echo json_encode($response);
?>