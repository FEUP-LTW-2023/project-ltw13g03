<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: /pages/login.php");
    }
    
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/ticket.php');

    output_header();

    output_main_content();

    output_footer();
?>