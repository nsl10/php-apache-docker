<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
    

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';
    
    //connect
    $database = new Database();
    $db = $database->connect();

    //instantiate
    $post = new Post($db);

    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $post->author = $data->author;
    //$post->id = $data->id;

    //create post
    if($post->create()) {
        echo json_encode(
            array('message' => 'Post Created')
        );
    }else{
    echo json_encode(
        array('message' => 'Post Not Created')
    );
}
