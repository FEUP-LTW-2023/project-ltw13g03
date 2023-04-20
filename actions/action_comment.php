<?php
  session_start();

  require_once(__DIR__ . '/../database/tickets.php');

  addComment($_POST['ticketId'], $_SESSION['username'], $_POST['text']);

  header('Location: /pages/ticket.php?id=' . $_POST['ticketId']);

?>