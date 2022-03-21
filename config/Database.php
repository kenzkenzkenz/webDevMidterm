<?php
    class Database{
        //DB Params
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);

        $host = $dbparts['host'];
        $db_name = ltrim($dbparts['path'], '/');
        $username = $dbparts['user'];
        $password = $dbparts['pass'];

        private $db;

        public function __construct(){
            $this->db = null;
        }

        public function connect(){
        
            try {
                $this->db = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            } catch (PDOException $error) {
                echo "Connection failed:" . $error->$getMessage();
            }

        return $this->db;
    }
}
