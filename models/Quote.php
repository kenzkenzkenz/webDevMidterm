<?php
    class Quote {
        //Database Info
        private $conn;
        private $table = 'quotes';

        //Quote Properties
        public $id;
        public $quote;
        public $author;
        public $category;

        public $categoryId;
        public $category_id;
        public $category_name;
        public $authorId;
        public $author_id;
        public $author_name;

        //Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        //Get Quotes
        public function read(){
            //Create query
            $query = 'SELECT
                    quotes.id,
                    quotes.quote,
                    authors.author,
                    categories.category
                FROM
                    ' . $this->table . '
                LEFT JOIN
                    authors ON authors.id = quotes.authorId
                LEFT JOIN
                    categories ON categories.id = quotes.categoryId
                ORDER BY
                    quotes.id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();

            return $stmt;
        }

        //Get Single Quote
        public function read_single(){
            $query = 'SELECT
                    quotes.id,
                    quotes.quote,
                    authors.author,
                    categories.category
                FROM
                    ' . $this->table . '
                LEFT JOIN
                    authors ON authors.id = quotes.authorId
                LEFT JOIN
                    categories ON categories.id = quotes.categoryId
                WHERE
                    quotes.id = :id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind ID
            $stmt->bindParam(':id', $this->id);

            //Execute query
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->id = $row['id'];
            $this->quote = $row['quote'];
            $this->author = $row['author'];
            $this->category = $row['category'];
        }


        
    // Create Post
    public function create(){
        //Create query
        $query = 'INSERT INTO ' . 
            $this->table . '
            SET
                quote = :quote,
                authorId = :author,
                categoryId = :category';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category = htmlspecialchars(strip_tags($this->category));


        //Bind data
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category', $this->category);


        //Execute query
        if($stmt->execute()){
            return true;
        }

        //Print error if something goe wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Post
    public function update(){
        //Create query
        $query = 'UPDATE ' . 
            $this->table . '
            SET
                quote = :quote,
                authorId = :author,
                categoryId = :category
            WHERE
                id = :id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category = htmlspecialchars(strip_tags($this->category));


        //Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category', $this->category);


        //Execute query
        if($stmt->execute()){
            return true;
        }

        //Print error if something goe wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    //Delete post
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

    // //is valid function
    // function isValid($id, $model){
    //     $model->id = $id;
    //     $modelResult = $model->read_single();
    //     return $modelResult;
    // }

    public function readQuotesByAuthorId(){
        //Create query
        $query = 'SELECT
                quotes.id,
                quotes.quote,
                authors.author,
                categories.category
            FROM
                ' . $this->table . '
            LEFT JOIN
                authors ON quotes.authorId = authors.id
            LEFT JOIN
                categories ON quotes.categoryId = categories.id
            WHERE
                quotes.authorId = :authorId';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':authorId', $this->authorId);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    public function readQuotesByCategoryId(){
        //Create query
        $query = 'SELECT
                quotes.id,
                quotes.quote,
                authors.author,
                categories.category
            FROM
                ' . $this->table . '
            LEFT JOIN
                authors ON quotes.authorId = authors.id
            LEFT JOIN
                categories ON quotes.categoryId = categories.id
            WHERE
                quotes.categoryId = :categoryId';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':categoryId', $this->categoryId);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    public function readQuotesByCombo(){
        //Create query
        $query = 'SELECT
                quotes.id,
                quotes.quote,
                authors.author,
                categories.category
            FROM
                ' . $this->table . '
            LEFT JOIN
                authors ON quotes.authorId = authors.id
            LEFT JOIN
                categories ON quotes.categoryId = categories.id
            WHERE
                quotes.authorId = :authorId && quotes.categoryId = :categoryId';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);

        //Execute query
        $stmt->execute();

        return $stmt;
    }
}