<?php
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/ticket.php');

    output_header();

    new_ticket_form();

    output_footer();
?>