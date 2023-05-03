<?php
require_once(__DIR__ . '/../database/connection.db.php');

session_start();

$db = getDatabaseConnection();

$name = $_POST['name'];
$username = $_SESSION['username'];
$email = $_POST['email'];

$id = Client::getUserId($db, $_SESSION['username']);
$stmt = $db->prepare('UPDATE Client SET name=?, email=?, username=? WHERE userId=?');
$stmt->execute(array($name, $email, $username, $id));


$response = array('success' => true);
header('Content-Type: application/json');
echo json_encode($response);