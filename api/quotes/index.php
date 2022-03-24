<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    }

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';
    include_once '../../models/Author.php';
    include_once '../../models/Category.php';

    $isId = filter_input(INPUT_GET, "id"); //assign if id
    $isAuthorId = filter_input(INPUT_GET, "authorId"); //if authorId
    $isCatId = filter_input(INPUT_GET, "categoryId"); //assign cat id

    if ($method == 'GET' && $isId){//just id
        include 'read_single.php';
    }

    elseif ($method == 'GET' && !$isId) {
        include 'read.php'; //if no id's, show all quotes
    }

    elseif ($method == 'GET' && $isAuthorId){//just authorId
        include 'read_author.php';
    }

    elseif ($method == 'GET' && $isCatId){ //just categoryId
        include 'read_category.php';
        if($isAuthorId){ //both authorId and categoryId
            include 'read_combo.php';
        }
    }

    // elseif ($isAuthorId && $isCatId){ //both authorId and categoryId
    //     include 'read_combo.php';
    // }

    //Post/Create a quote
    elseif ($method === 'POST'){
        include 'create.php';
    }
    //Put/Update a quote
    elseif($method === 'PUT'){
        include 'update.php';
    }
    //Delete a quote
    elseif($method === 'DELETE'){
        include 'delete.php';
    }