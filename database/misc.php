<?php

    require_once(__DIR__ . '/../database/connection.db.php');

    function getHashtags() {
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT name FROM Hashtag');
        $stmt->execute();
    
        return $stmt->fetchAll();
    }

    function getStatuses() {
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT name FROM Status');
        $stmt->execute();

        return $stmt->fetchAll();
    }

?>