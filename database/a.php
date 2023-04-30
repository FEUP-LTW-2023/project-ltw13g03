<?php
    require_once(__DIR__ . '/../database/client.class.php');
    require_once(__DIR__ . '/../database/connection.db.php');

    $db = getDatabaseConnection();
    //Client::updateUserDepartments($db, "RAM", "Human Resources");
    $stmt = $db->prepare('SELECT name from AgentDepartment JOIN Department using(departmentId) WHERE username = ?');
    $stmt->execute(array("RAM"));
    $dep = $stmt->fetchAll();
    echo $dep[2]["name"];
?>