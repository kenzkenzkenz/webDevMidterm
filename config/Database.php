<?php
    class Database{

        $url;
        $dbparts;
        $host;
        $db_name;
        $username;
        $password;

        public function __construct(){
            $this->db = null;
            $this->url = getenv('JAWSDB_URL');
            $dbparts = parse_url($url);
            $host = $dbparts['host'];
            $db_name = ltrim($dbparts['path'], '/');
            $username = $dbparts['user'];
            $password = $dbparts['pass'];
        
    
        try {
            $this->db = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        } catch (PDOException $e) {
            $error_message = 'Database Error: ';
            $error_message .= $e->getMessage();
            echo $error_message;
            exit('Unable to connect to the database');
        }

        return $this->db;
    }
}
