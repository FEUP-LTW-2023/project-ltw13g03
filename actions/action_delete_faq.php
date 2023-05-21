<?php
session_start();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/ticket.class.php');
require_once(__DIR__ . '/../database/client.class.php');

$db = getDatabaseConnection();

try {
    $stmt = $db->prepare('INSERT INTO FAQ (question, answer) VALUES (?, ?)');

    $stmt->execute(array(
        $_POST['faq_question'],
        $_POST['faq_answer']
    ));
    header('Location: /pages/faq.php');
}
catch (PDOException $err) {
    $_SESSION['new_faq_error'] = 'Something went wrong.';
    header('Location: /pages/new_faq.php');
}

?>