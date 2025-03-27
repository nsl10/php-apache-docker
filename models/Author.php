<?php
    class POST{
        private $conn;
        private $table = 'posts';

        //properties
        public $id;
        public $category_id;
        public $catagory;
        public $author_id;
        public $author;
        public $quote;

        //constructor
        public function __construct($db){
            $this->conn = $db;
        }

        //get post
        public function read() {
            //create query
            $query = 'use nathan_lynott_test_postgesql SELECT id, author FROM authors';

            //statement
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        //get single post
        public function read_single() {
            $query = 'use nathan_lynott_test_postgesql SELECT id, author FROM authors where id = ?';
            
            // prepare statement
            $stmt = $this->conn->prepare($query);

            //bind id
            $stmt->bindParam(1, $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->author = $row['author'];
        }

        //create post

        public function create() {
            $query = 'use nathan_lynott_test_postgesql INSERT INTO authors (id, author) values((select (max(id)+1) from authors), :author)';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data

            $this->author = htmlspecialchars(strip_tags($this->author));
            //$this->id = htmlspecialchars(strip_tags($this->id));

            //bind
            $stmt->bindParam(':author', $this->author);
            //$stmt->bindParam(':id', $this->id);

            //execute
            if($stmt->execute()){
                return true;
            }else{
            printf("Error: %s.\n", $stmt->error);
            return false;
            }
        }

        //Update post

        public function update() {
            $query = 'use nathan_lynott_test_postgesql update authors set author = :author where id = :id';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data

            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->id = htmlspecialchars(strip_tags($this->id));

            //bind
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':id', $this->id);

            //execute
            if($stmt->execute()){
                return true;
            }else{
            printf("Error: %s.\n", $stmt->error);
            return false;
            }
        }

        //delete post

        public function delete() {
            // create query
            $query = 'use nathan_lynott_test_postgesql DELETE FROM AUTHORS WHERE id = :id';
            
            // prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            
            $this->id = htmlspecialchars(strip_tags($this->id));
            
            //bind
            $stmt->bindParam(':id', $this->id);

            //execute
            if($stmt->execute()){
                return true;
            }else{
            printf("Error: %s.\n", $stmt->error);
            return false;
            }

        }
    }

