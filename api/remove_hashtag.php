<?php
    declare(strict_types = 1);

    session_start();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/ticket.class.php');
    require_once(__DIR__ . '/../database/client.class.php');

    if(!isset($_SESSION['username'])){
        header("Location: /pages/login.php");
    } else {
        $db = getDatabaseConnection();

        $hashtags = Ticket::removeHashtag($db, intval($_GET['ticketId'], 10), $_GET['hashtag'], Client::getUserId($db, $_SESSION['username']));

        echo $hashtags;        
    }
?>