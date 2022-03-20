<?php
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);

    $host = $dbparts['host'];
    $db_name = ltrim($dbparts['path'], '/');
    $username = $dbparts['user'];
    $password = $dbparts['pass'];

    try {
        $db = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        $error_message = 'Database Error: ';
        $error_message .= $e->getMessage();
        echo $error_message;
        exit('Unable to connect to the database');
    }