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

    $isId = filter_input(INPUT_GET, "id"); //assign the id

    //Read all categories
    if($method === 'GET' && empty($isId)){
        include 'read.php';
    }

    //Read single category by id
    elseif ($method === 'GET' && isset($isId)){
        include 'read_single.php';
    }

    //Post/Create a category
    elseif($method === 'POST'){
        include 'create.php';
    }

    //Put/Update a category
    elseif($method === 'PUT'){
        include 'update.php';
    }

    //Delete a category
    elseif($method === 'DELETE'){
        include 'delete.php';
    }