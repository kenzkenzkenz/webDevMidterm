<?php
    class Database {
        //Database Parameters
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);
    
        $host = $dbparts['host'];
        $db_name = ltrim($dbparts['path'], '/');
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        private $conn;

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