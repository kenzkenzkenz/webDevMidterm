<?php
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

    //Quote query
    $result = $quote->read();
    //Get row count
    $num = $result->rowCount();

    //Check if any quotes
    if($num > 0){
        //Quote array
        $quotes_arr = array();
        $quotes_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $quote_item = array(
                'id' => $id,
                'quote' => html_entity_decode($quote),
                'author' => $author,
                'category' => $category

            );

            //Push to "data"
            array_push($quotes_arr['data'], $quote_item);
        }

        //Convert to JSON and output
        echo json_encode($quotes_arr);
    } else {
        // No quotes
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    }