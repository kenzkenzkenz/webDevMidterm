<?php
    class Database {
        private $url;
        private $conn;

        function __construct(){
            $this->conn = null;
            $this->url = getenv('JAWSDB_URL');
        }

        //Database Connect
        public function connect(){

            $dbparts = parse_url($this->url);
            
            $host = $dbparts['host'];
            $db_name = ltrim($dbparts['path'], '/');
            $username = $dbparts['user'];
            $password = $dbparts['pass'];

            try {
                $this->conn = new PDO('mysql:host=' . $host . ';db_name=' . $db_name, $username, $password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }
    }