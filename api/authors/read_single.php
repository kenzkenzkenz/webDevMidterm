<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';
    include_once '../../models/Author.php';
    include_once '../../models/Category.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate author object
    $author = new Author($db);

    // Get ID
    $author->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get author
    $author->read_single();

    //Create array
    $author_arr = array(
        'id' => $author->id,
        'author' => $author->author
    );

    if($author->id !== null){
        print_r(json_encode($author_arr));
    } else {
        echo json_encode(
            array('message' => 'authorId Not Found')
        );
    }