<?php

    require_once(__DIR__ . '/../database/connection.db.php');

    function getDepartments() {
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT name FROM Department');
        $stmt->execute();
    
        return $stmt->fetchAll();
    }

    function getHashtags() {
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT name FROM Hashtag');
        $stmt->execute();
    
        return $stmt->fetchAll();
    }

?>