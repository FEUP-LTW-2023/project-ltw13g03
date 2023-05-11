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

    function insertStatus(string $status) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('INSERT INTO Status (name) VALUES (?)');
        $stmt->execute(array($status));
    }

    function statusExists(string $name) {
        $db = getDatabaseConnection();

        $stmt = $stmt = $db->prepare('SELECT name FROM Status WHERE name = ?');
        $stmt->execute(array($name));
        
        $res = $stmt->fetch();
        if (!$res) return false;
        return true;
    }
?>