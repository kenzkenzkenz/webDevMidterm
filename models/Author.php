<?php
    class Author{
        //Database stuff
        private $conn;
        private $table = 'authors';

        //Properties
        public $id;
        public $author;

        //Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        //Get categories
        public function read(){
            //Create query
            $query = 'SELECT
                    id,
                    author
                FROM
                    ' . $this->table . '
                ORDER BY
                    id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();

            return $stmt;
        }

        //Get Single Author
        public function read_single(){
            $query = 'SELECT
                    id,
                    author
                FROM
                    ' . $this->table . '
                WHERE
                    id = ?
                LIMIT 0,1';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(1, $this->id);

        //Execute query
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set properties
        $this->id = $row['id'];
        $this->author = $row['author'];
        }

        
    // Create author
    public function create(){
        //Create query
        $query = 'INSERT INTO ' . 
            $this->table . '
            SET
                author = :author';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->author = htmlspecialchars(strip_tags($this->author));


        //Bind data
        $stmt->bindParam(':author', $this->author);


        //Execute query
        if($stmt->execute()){
            return true;
        }

        //Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update author
    public function update(){
        //Create query
        $query = 'UPDATE ' . 
            $this->table . '
            SET
                author = :author
            WHERE
                id = :id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->author = htmlspecialchars(strip_tags($this->author));


        //Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':author', $this->author);


        //Execute query
        if($stmt->execute()){
            return true;
        }

        //Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    //Delete author
    public function delete(){
        //Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        //Execute query
        if($stmt->execute()){
            return true;
        }

        //Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}