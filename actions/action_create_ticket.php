<?php
  session_start();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/ticket.class.php');

  $db = getDatabaseConnection();
    
  Ticket::createTicket(
    $db, 
    $_POST['ticket_title'], 
    $_POST['ticket_description'], 
    $_POST['tags'], 
    $_POST['ticket_priority'],
    $_SESSION['username']
    );

    header('Location: /pages/');
?>