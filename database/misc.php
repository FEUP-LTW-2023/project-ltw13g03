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

    function getDepartment($id) {
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT name FROM Department WHERE departmentId=?');
        $stmt->execute(array($id));
    
        return $stmt->fetch()['name'];
    }

    function getDepartmentId($name) {
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT departmentId FROM Department WHERE name=?');
        $stmt->execute(array($name));
    
        return $stmt->fetch()['departmentId'];
    }

?>