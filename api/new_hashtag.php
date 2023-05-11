<?php
    declare(strict_types = 1);

    session_start();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/misc.php');

    $response = NULL;
    if(!isset($_SESSION['username'])){
        header("Location: /pages/login.php");
    } else {
        $db = getDatabaseConnection();
        $hashtag = $_GET['hashtag'];

        if ($hashtag != "" && !hashtagExists($hashtag)) {
            insertHashtag($hashtag);
            $response = true;
        }
    }

    echo json_encode($response);
?>