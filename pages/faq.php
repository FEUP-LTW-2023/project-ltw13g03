<?php
require_once(__DIR__ . '/../templates/common.php');
require_once(__DIR__ . '/../templates/question.php');

session_start();

output_header(isset($_SESSION['username']));

output_questions();

output_footer();
?>