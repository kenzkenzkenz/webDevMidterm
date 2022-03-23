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

    //Instantiate category object
    $category = new Category($db);

    // Get ID
    $category->id = isset($_GET['categoryId']) ? $_GET['categoryId'] : die();

    //Get category
    $category->read_single();

    //Create array
    $cat_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );

    if($category->id !== null){
        print_r(json_encode($cat_arr));
    } else {
        echo json_encode(
            array('message' => 'categoryId Not Found')
        );
    }