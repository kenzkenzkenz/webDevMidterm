<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';
    include_once '../../models/Author.php';
    include_once '../../models/Category.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate object
    $author = new Author($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //$author->id = $data->id; //not nec bc of auto-increment
    $author->author = $data->author;

    //Create post
    if($author->create()){
        echo json_encode(
            array('message' => 'Author Created')
        );
        
    }else{
        echo json_encode(
            array('message' => 'Author Not Created')
        );
    }