<?php
require_once(__DIR__ . '/../database/connection.php');

session_start();

$db = getDatabaseConnection();

$name = $_POST['name'];
$username = $_SESSION['username'];
$email = $_POST['email'];

$stmt = $db->prepare('UPDATE Client SET name=?, email=? WHERE username=?');
$stmt->execute(array($name, $email, $username));


$response = array('success' => true);
header('Content-Type: application/json');
echo json_encode($response);