<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
    

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';
    
    //connect
    $database = new Database();
    $db = $database->connect();

    //instantiate
    $post = new Post($db);

    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $post->id = $data->id;

    //delete post
    if($post->delete()) {
        echo json_encode(
            array('message' => 'Post Deleted')
        );
    }else{
    echo json_encode(
        array('message' => 'Post Not Deleted')
    );
}
