<?php
#$host = "172.26.153.159";
class Database {
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;
  
    public function __construct($host,$username,$password,$database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        try {
            $dsn = "mysql:host=$this->host;dbname=$this->database;charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }

    public function createTable($tablename){
        $sql = "CREATE TABLE $tablename (
            fullname VARCHAR(255) NOT NULL,
            username VARCHAR(50) NOT NULL UNIQUE,
            phone_number VARCHAR(20) NOT NULL,
            age INT NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            user_password VARCHAR(255) NOT NULL
        )";
        try {
            $this->conn->exec($sql);
            echo "Table $tablename created successfully";
        } catch(PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
        }
    }
    public function deleteTable($tablename){
        $sql = "DROP TABLE $tablename";
        try {
            $this->conn->exec($sql);
            echo "Table $tablename created successfully";
        } catch(PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
        }
    }
}

?>