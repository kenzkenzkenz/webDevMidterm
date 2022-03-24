<?php

//this file is a copy of /quotes/read.php except where noted

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';
    include_once '../../models/Author.php';
    include_once '../../models/Category.php';

    //Instantiate Database & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate quote object
    $quote = new Quote($db);

    $quote->id = isset($_GET['id']) ? $_GET['id'] : die(); //added

    //Quote query
    $result = $quote->readQuotesByAuthorId(); //changed from read() to new function
    //Get row count
    $num = $result->rowCount();

    //Check if any quotes
    if($num > 0){
        //Quote array
        $quotes_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $quote_item = array(
                'id' => $quote->id,
                'quote' => html_entity_decode($quote->quote),
                'author' => $quote->author,
                'category' => $quote->category
            );

            //Push to "data"
            array_push($quotes_arr, $quote_item);
        }

    }

    if($quote->id !== null){
        print_r(json_encode($quote_item));
    } else {
        // No quotes
        echo json_encode(
            array('message' => 'authorId Not Found')
        );
    }