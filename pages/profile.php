<?php
    require_once('../templates/common.php');
    require_once('../templates/ticket.php');
    require_once('../templates/user.php');

    output_header();

    output_user_profile();

    for ($i = 1; $i <= 3; $i++) {
        output_ticket_preview();
    }

    output_footer();
?>