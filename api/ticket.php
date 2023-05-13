<?php
    declare(strict_types = 1);

    session_start();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/ticket.class.php');
    require_once(__DIR__ . '/../database/client.class.php');

    if(!isset($_SESSION['username'])){
        header("Location: /pages/login.php");
    } else {
        $db = getDatabaseConnection();
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':

                break;
            case 'PUT':
                $params;
                parse_str(file_get_contents("php://input"),$params);
                if ($params['field'] === 'hashtag') {
                    $response = Ticket::addHashtag($db, intval($params['ticketId'], 10), $params['hashtag'], Client::getUserId($db, $_SESSION['username']));
                    if ($response === false) http_response_code(404);
                    else http_response_code(200);
                } else if ($params['field'] === 'agent') {
                    Ticket::changeAgent($db, intval($params['ticketId'],10), $params['agent'], Client::getUserId($db, $_SESSION['username']));
                    http_response_code(200);
                } else if ($params['field'] === 'department') {
                    Ticket::changeDepartment($db, intval($params['ticketId'],10), $params['department'], Client::getUserId($db, $_SESSION['username']));
                    http_response_code(200);
                } else if ($params['field'] === 'status') {
                    Ticket::changeStatus($db, intval($params['ticketId'],10), $params['oldStatus'], $params['newStatus'], Client::getUserId($db, $_SESSION['username']));
                    http_response_code(200);
                } else http_response_code(404);
                break;
            case 'DELETE':
                $params;
                parse_str(file_get_contents("php://input"),$params);
                if ($params['field'] === 'hashtag') {
                    $response = Ticket::removeHashtag($db, intval($params['ticketId'], 10), $params['hashtag'], Client::getUserId($db, $_SESSION['username']));
                    if ($response === false) http_response_code(404);
                    else http_response_code(200);
                } else http_response_code(400);
                break;
            default:
                http_response_code(404);
                break;
        }
    }
?>