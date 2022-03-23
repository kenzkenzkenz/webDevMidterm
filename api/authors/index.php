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

    //Read all authors
    if($method === 'GET' && empty($isId)){
        include 'read.php';
    }

    //Read single author by id
    elseif ($method === 'GET' && isset($isId)){
        include 'read_single.php';
    }

    //Post/Create an author
    elseif($method === 'POST'){
        include 'create.php';
    }

    //Put/Update an author
    elseif($method === 'PUT'){
        include 'update.php';
    }

    //Delete an author
    elseif($method === 'DELETE'){
        include 'delete.php';
    }