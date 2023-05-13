<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: /pages/login.php");
}

require_once(__DIR__ . '/../templates/common.php');
require_once(__DIR__ . '/../templates/question.php');

output_header(isset($_SESSION['username']));

output_FAQs();

output_footer();
?>