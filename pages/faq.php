<?php
require_once(__DIR__ . '/../templates/common.php');
require_once(__DIR__ . '/../templates/question.php');

output_header();

for ($i = 1; $i <= 5; $i++) {
    output_question();
}

output_footer();
?>