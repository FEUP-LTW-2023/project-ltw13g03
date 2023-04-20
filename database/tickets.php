<?php

require_once(__DIR__ . '/../database/connection.db.php');

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

function getComments($ticketId){
    $db = getDatabaseConnection();

    $stmt = $db->prepare('SELECT * FROM Comment WHERE ticketId=?');
    $stmt->execute(array($ticketId));

    return $stmt->fetchAll();
}

function addComment($ticketId, $username, $text){
    $date = date('Y-m-d');

    $db = getDatabaseConnection();

    $stmt = $db->prepare('INSERT INTO Comment (ticketID, username, date, text) VALUES (?, ?, ?, ?)');
    $stmt->execute(array($ticketId, $username, $date, $text));
}

?>