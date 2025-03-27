<?php
class Database {
    private $host;
    //private $port;
    private $dbname;
    private $username;
    private $password;
    private $conn;

    public function __construct(){
        $this->username = getenv('USERNAME');
        $this->password = getenv('PASSWORD');
        $this->dbname = getenv('DBNAME');
        $this->host = getenv('HOST');
        //$this->port = getenv('PORT');
    }
    public function connect() {
        if ($this->conn) {
            return $this->conn;
        }else{
        $dsn = "pgsql:host={$this->host};dbname={$this->dbname}";

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password);
            // 'mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $e) {
            echo 'Connection error ' . $e-> getMessage();
        }
    }
        //return $this->conn;
    }
}

//<?php
//class Database {
//    private $host = 'localhost';
//    private $port = '5432';
//    private $db_name = 'postgres';
//    private $username = 'postgres';
//    private $password = 'test';
//    private $conn;
//
//    public function connect() {
//        $this->conn = null;
//        $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";
//
//        try {
//            $this->conn = new PDO($dsn, $this->username, $this->password);
//            // 'mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password
//            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        } catch(PDOException $e) {
//            echo 'Connection error ' . $e-> getMessage();
//        }
//
//        return $this->conn;
//    }
//}
