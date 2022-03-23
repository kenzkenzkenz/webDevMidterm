<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    }

    $isId = filter_input(INPUT_GET, "id"); //assign if id
    $isAuthorId = filter_input(INPUT_GET, "authorId"); //if authorId
    $isCatId = filter_input(INPUT_GET, "categoryId"); //assign cat id

    // $exists = isValid($id, $quote);


    // //Determine id type
    // if (isset($_GET['id'])){
    //     $varId = true; //id
    // } else $varId = false;

    // if (isset($_GET['authorId'])){
    //     $varAuthorId = true; //authorId
    // } else $varAuthorId = false;

    // if (isset($_GET['categoryId'])){
    //     $varCategoryId = true; //categoryId
    // } else $varCategoryId = false;


    if ($isId){//just id
        include 'read_single.php';
    }

    elseif ($isAuthorId && !$isCatId){//just authorId
        include 'read_author.php';
    }

    elseif (!$isAuthorId && $isCatId){ //just categoryId
        include 'read_category.php';
    }

    elseif ($isAuthorId && $isCatId){ //both authorId and categoryId
        include 'read_combo.php';
    }

    else include 'read.php'; //if no id's, show all quotes
    

    //Post/Create a quote
    if ($method === 'POST'){
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