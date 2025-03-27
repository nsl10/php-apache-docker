<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }
    
    if ($method === 'GET') {
        require_once 'read.php';
        exit();
    }
    
    if ($method === 'POST') {
        header('Access-Control-Allow-Methods: POST');
        exit();
    }
    
    if ($method === 'PUT') {
        header('Access-Control-Allow-Methods: PUT');
        exit();
    }
    
    if ($method === 'DELETE') {
        header('Access-Control-Allow-Methods: DELETE');
        exit();
    }
