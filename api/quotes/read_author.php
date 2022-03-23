<?php

//this file is a copy of /quotes/read.php except where noted

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    //Instantiate Database & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate quote object
    $quote = new Quote($db);

    $quote->authorId = isset($_GET['authorId']) ? $_GET['authorId'] : die(); //added

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
                'id' => $id,
                'quote' => html_entity_decode($quote),
                'author' => $author,
                'category' => $category
            );

            //Push to "data"
            array_push($quotes_arr, $quote_item);
        }

        //Convert to JSON and output
        echo json_encode($quotes_arr);
    } else {
        // No quotes
        echo json_encode(
            array('message' => 'authorId Not Found')
        );
    }