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
        isset($_GET['id']) ? require_once 'read_single.php' : require 'read.php';
        exit();
    }
    
    if ($method === 'POST') {
        require_once 'create.php';
        exit();
    }
    
    if ($method === 'PUT') {
        require_once 'update.php';
        exit();
    }
    
    if ($method === 'DELETE') {
        require_once 'delete.php';
        exit();
    }
