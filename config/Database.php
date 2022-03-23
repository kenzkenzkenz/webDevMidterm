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
            $dbname = ltrim($dbparts['path'], '/');
            $username = $dbparts['user'];
            $password = $dbparts['pass'];

            try {
                $this->conn = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }
    }