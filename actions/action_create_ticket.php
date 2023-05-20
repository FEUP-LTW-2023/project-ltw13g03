<?php
  session_start();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/ticket.class.php');
  require_once(__DIR__ . '/../database/client.class.php');

  $db = getDatabaseConnection();
    
  try {
      Ticket::createTicket(
          $db,
          $_POST['ticket_title'],
          $_POST['ticket_description'],
          $_POST['department'],
          $_POST['tags'],
          $_POST['ticket_priority'],
          Client::getUserId($db, $_SESSION['username']));
      header('Location: /pages/');
  }
  catch (PDOException $err) {
      $_SESSION['new_ticket_error'] = 'Something went wrong.';
      header('Location: /pages/new_ticket.php');
  }

?>