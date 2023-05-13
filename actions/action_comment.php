<?php
  session_start();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/ticket.class.php');

  $db = getDatabaseConnection();
  Ticket::addComment($db, $_POST['ticketId'], $_SESSION['username'], $_POST['text'], $_POST['faq']);

  header('Location: /pages/ticket.php?id=' . $_POST['ticketId']);

?>