<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: /pages/login.php");
    }

    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/users.php');
    $user = getUserInfo($_SESSION['username']);

    if (!$user['isAdmin']) {
        header("Location: /pages/index.php");
    }

    output_header(true);

    output_users();

    output_footer();
?>