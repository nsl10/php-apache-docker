<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/Author.php';
    
    //connect
    $database = new Database();
    $db = $database->connect();

    //instantiate
    $post = new Post($db);

    //get id
    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    //get post
    $post->read_single();

    $post_arr = array(
        'id' => $post->id,
        'author' => $post->author
    );

    //to json
    print_r(json_encode($post_arr));