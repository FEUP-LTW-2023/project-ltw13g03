<?php
    declare(strict_types = 1);

    session_start();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/client.class.php');

    if(!isset($_SESSION['username'])){
        header("Location: /pages/login.php");
    } else {
        $db = getDatabaseConnection();
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':

                break;
            case 'POST':
                $params;
                parse_str(file_get_contents("php://input"),$params);
                if ($params['field'] === 'department') {
                    $client = Client::getUser($db, $_SESSION['username']);
                    if ($client->isAdmin) {
                        if (Client::updateUserDepartments($db, $params['username'], $params['value'], true) === false)
                            http_response_code(404);
                    }
                    $response = Client::getUser($db, $params['username']);
                    echo json_encode($response);
                    http_response_code(200);
                } else http_response_code(400);
                break;
            case 'PUT':
                $params;
                parse_str(file_get_contents("php://input"),$params);
                if ($params['field'] === 'role') {
                    $client = Client::getUser($db, $_SESSION['username']);
                    if ($client->isAdmin) {
                        Client::updateUserRole($db, $params['username'], (bool) $params['isAgent'], (bool) $params['isAdmin']);
                    }
                    $response = Client::getUser($db, $params['username']);
                    echo json_encode($response);
                    http_response_code(200);
                }
                break;
            case 'DELETE':
                $params;
                parse_str(file_get_contents("php://input"),$params);
                if ($params['field'] === 'department') {
                    $client = Client::getUser($db, $_SESSION['username']);
                    if ($client->isAdmin) {
                        if (Client::updateUserDepartments($db, $params['username'], $params['value'], false) === false)
                            http_response_code(404);
                    }
                    $response = Client::getUser($db, $params['username']);
                    echo json_encode($response);
                    http_response_code(200);
                } else http_response_code(400);
                break;
            default:
                http_response_code(404);
                break;
        }
    }
?>