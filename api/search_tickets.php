<?php

    session_start();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/ticket.class.php');

    $db = getDatabaseConnection();

    $tickets = Ticket::getTicketsFiltered($db, $_GET['search'], $_GET['status'], $_GET['priority']);

    echo json_encode($tickets);
?>