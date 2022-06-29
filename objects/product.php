<?php
class Product{
  
    // database connection and table name
    private $conn;
    private $table_name = "Product";
  
    // object properties
    public $id;
    public $sku;
    public $name;
    public $price;
    public $type;
    public $size;
    public $height;
    public $width;
    public $length;
    public $weight;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
    function read(){
    
        // select all query
    $query = "SELECT *
              FROM  " . $this->table_name . " ORDER BY sku ASC ";
    
        // prepare query statement
        $statement = $this->conn->prepare($query);
    
        // execute query
        $statement->execute();
    
        return $statement;
    }

  // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
        " . $this->table_name . "
            SET
                sku=:sku, name=:name, price=:price, type=:type, size=:size, height=:height, width=:width, length=:length, weight=:weight";

     // prepare query
     $statement = $this->conn->prepare($query);

    // sanitize
    $this->sku=htmlspecialchars(strip_tags($this->sku));
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->price=htmlspecialchars(strip_tags($this->price));
    $this->type=htmlspecialchars(strip_tags($this->type));
    $this->size=htmlspecialchars(strip_tags($this->size));
    $this->height=htmlspecialchars(strip_tags($this->height));
    $this->width=htmlspecialchars(strip_tags($this->width));
    $this->length=htmlspecialchars(strip_tags($this->length));
    $this->weight=htmlspecialchars(strip_tags($this->weight));

    // bind values
    $statement->bindParam(":sku", $this->sku);
    $statement->bindParam(":name", $this->name);
    $statement->bindParam(":price", $this->price);
    $statement->bindParam(":type", $this->type);
    $statement->bindParam(":size", $this->size);
    $statement->bindParam(":height", $this->height);
    $statement->bindParam(":width", $this->width);
    $statement->bindParam(":length", $this->length);
    $statement->bindParam(":weight", $this->weight);

    // execute query
    if($statement->execute()){
        return true;
    }

    return false;
        
    } 
    // delete products
    function delete(){
         // query to delete record
         $query = "DELETE FROM
         " . $this->table_name . "
            WHERE id = :id";
 
      // prepare query
      $statement = $this->conn->prepare($query);

       // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));


    // bind values
    $statement->bindParam(":id", $this->id);

    if($statement->execute()){
        return true;
    }

    printf("Error %s. \n", $statement->error);

    }
  
}
?>