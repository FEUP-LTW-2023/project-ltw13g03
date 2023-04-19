<?php

require_once(__DIR__ . '/../database/connection.php');

function getTickets(){
    $db = getDatabaseConnection();

    $stmt = $db->prepare('SELECT ticketId, status, date FROM Ticket');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getTicket($ticketId){
    $db = getDatabaseConnection();

    $stmt = $db->prepare('SELECT * FROM Ticket WHERE ticketId=?');
    $stmt->execute(array($ticketId));

    return $stmt->fetch();
}

?>