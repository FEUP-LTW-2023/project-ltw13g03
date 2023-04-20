<?php
    declare(strict_types = 1);

    # check session

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.class.php');

    $db = getDatabaseConnection();
    $roles = Client::updateUserRole($db, $_GET['username'], (bool) $_GET['isAgent'], (bool) $_GET['isAdmin']);
?>