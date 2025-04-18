<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';
    
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
        //$post_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $post_item = array(
                'id' => $id,
                'quote' => $quote,
                'author_id' => $author_id,
                'category_id' => $category_id
            );

            //push to data
            array_push($post_arr, $post_item);

        }
        echo json_encode($post_arr);
    } else {
        echo json_encode(array('message'=> 'No Post Found'));
    }
