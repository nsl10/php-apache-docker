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
            $query = 'SELECT id, quote, author_id, category_id FROM quotes';

            //statement
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        //get single post
        public function read_single() {
            $query = 'SELECT id, quote, author_id, category_id FROM quotes where id = ?';
            
            // prepare statement
            $stmt = $this->conn->prepare($query);

            //bind id
            $stmt->bindParam(1, $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->quote = $row['quote'];
            $this->author_id = $row['author_id'];
            $this->category_id = $row['category_id'];
        }
        
        //create post

        public function create() {
            $query = 'INSERT INTO quotes (id, quote, author_id, category_id) values((select (max(id)+1) from quotes), :quote, :author_id, :category_id)';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data

            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));


            //bind
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);

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
            $query = 'update quotes set quote = :quote, author_id = :author_id, category_id = :category_id where id = :id';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data

            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));

            //bind
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);
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
            $query = 'DELETE FROM quotes WHERE id = :id';
            
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