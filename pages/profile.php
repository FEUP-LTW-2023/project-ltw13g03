<?php
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/ticket.php');
    require_once(__DIR__ . '/../templates/user.php');

    output_header();

    output_user_profile();

    for ($i = 1; $i <= 3; $i++) {
        output_ticket_preview();
    }

    output_footer();
?>