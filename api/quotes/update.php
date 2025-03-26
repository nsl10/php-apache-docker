<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
    

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';
    
    //connect
    $database = new Database();
    $db = $database->connect();

    //instantiate
    $post = new Post($db);

    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $post->quote = $data->quote;
    $post->id = $data->id;
    $post->author_id = $data->author_id;
    $post->category_id = $data->category_id;

    //update post
    if($post->update()) {
        echo json_encode(
            array('message' => 'Post Updated')
        );
    }else{
    echo json_encode(
        array('message' => 'Post Not Updated')
    );
}
