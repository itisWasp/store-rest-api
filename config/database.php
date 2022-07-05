<?php

use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv(__DIR__ . "/..");
$dotenv->load();


class Database{
  
    // specify database credentials
    // private $host = "localhost";
    // private $db_name = "Products";
    // private $username = "root";
    // private $password = "";
    public $conn;
  
    // get the database connection
    public function getConnection(){

         $host = getenv('DB_HOST');
         $db_name = getenv('DB_DATABASE');
         $username = getenv('DB_USERNAME');
         $password = getenv('DB_PASSWORD');
  
        $this->conn = null;
  
        try{
            // $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>