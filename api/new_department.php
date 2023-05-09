<?php
    declare(strict_types = 1);

    session_start();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/department.php');

    $response = NULL;
    if(!isset($_SESSION['username'])){
        header("Location: /pages/login.php");
    } else {
        $db = getDatabaseConnection();
        $dep = $_GET['department'];
        $deps = getDepartmentId($dep);
        if ($dep !== "" && is_null($deps)) {
            insertDepartment($dep);
            $response = true;
        }
    }

    echo json_encode($response);
?>