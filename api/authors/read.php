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

    //query
    $result = $post->read();
    
    $num = $result->rowCount();

    if($num >0) {
        $post_arr = array();
        $post_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $post_item = array(
                'id' => $id,
                'author' => $author
            );

            //push to data
            array_push($post_arr['data'], $post_item);

        }
        echo json_encode($post_arr);
    } else {
        echo json_encode(array('message'=> 'No Post Found'));
    }