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
            $query = 'SELECT id, category FROM categories';

            //statement
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        //get single post
        public function read_single() {
            $query = 'SELECT id, category FROM categories where id = ?';
            
            // prepare statement
            $stmt = $this->conn->prepare($query);

            //bind id
            $stmt->bindParam(1, $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->category = $row['category'];
        }

        //create post

        public function create() {
            $query = 'INSERT INTO categories (id, category) values((select (max(id)+1) from categories), :category)';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data

            $this->category = htmlspecialchars(strip_tags($this->category));
            //$this->id = htmlspecialchars(strip_tags($this->id));

            //bind
            $stmt->bindParam(':category', $this->category);
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
            $query = 'update categories set category = :category where id = :id';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data

            $this->category = htmlspecialchars(strip_tags($this->category));
            $this->id = htmlspecialchars(strip_tags($this->id));

            //bind
            $stmt->bindParam(':category', $this->category);
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
            $query = 'DELETE FROM categories WHERE id = :id';
            
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