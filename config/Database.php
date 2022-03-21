<?php
    class Database {
        //Database Parameters
        private $conn;
        private $url;

        $dbparts = parse_url($url);
        $this->url = getenv('JAWSDB_URL');
        $dbparts = parse_url($this->url);
        
        $host = $dbparts['host'];
        $db_name = ltrim($dbparts['path'], '/');
        $username = $dbparts['user'];
        $password = $dbparts['pass'];

        //Database Connect
        public function connect(){
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . 
                $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }
    }