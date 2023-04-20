<?php
    session_start();

    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/users.php');

    output_header(true);

    output_users();

    output_footer();
?>