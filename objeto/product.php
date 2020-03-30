<?php
class Product{
  
    // database connection and table name
    private $conn;
    private $table_name = "products";
  
    // object properties
    public $id;
    public $description;
    public $completed;
    public $price;
    public $category_id;
    public $category_description;
    public $createdAt;
    public $updatedAt;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){
  
    // select all query
    /*$query = "SELECT
                c.description as category_description, p.id, p.description, p.completed, p.price, p.category_id, p.createdAt, p.updatedAt
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    category c
                        ON p.category_id = c.id
            ORDER BY
                p.createdAt DESC";*/
                $query = "SELECT *  FROM " . $this->table_name . " ORDER BY  createdAt DESC";
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
    print_r($stmt);
    return $stmt;
    }

    // create product
function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            description=:description  price=:price, category_id=:category_id, createdAt=:createdAt";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->price=htmlspecialchars(strip_tags($this->price));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
    $this->createdAt=htmlspecialchars(strip_tags($this->createdAt));
  
    // bind values
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":price", $this->price);
    $stmt->bindParam(":category_id", $this->category_id);
    $stmt->bindParam(":createdAt", $this->createdAt);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
    }
    // used when filling up the update product form
function readOne(){
  
   // used when filling up the update product form

  
    // query to read single record
    $query = "SELECT   *  FROM " . $this->table_name . " p
            WHERE
                p.id = ?
            LIMIT
                0,1";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
  print_r($stmt);
    // execute query
    $stmt->execute();
  
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    // set values to object properties
    $this->price = $row['price'];
    $this->description = $row['description'];
    $this->category_id = $row['category_id'];
    $this->category_name = $row['category_name'];
}
    // update the product
function update(){
  
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                description = :description,
                price = :price,
                category_id = :category_id
            WHERE
                id = :id";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->price=htmlspecialchars(strip_tags($this->price));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
    $this->id=htmlspecialchars(strip_tags($this->id));
  
    // bind new values
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':price', $this->price);
    $stmt->bindParam(':category_id', $this->category_id);
    $stmt->bindParam(':id', $this->id);
  
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
    }
    // delete the product
function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
    }
// search products
function search($keywords){
  
    // select all query
    $query = "SELECT
                c.description as category_description, p.id, p.description, p.price, p.category_id, p.createdAt
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    category c
                        ON p.category_id = c.id
            WHERE
                p.description LIKE ? OR c.description LIKE ?
            ORDER BY
                p.createdAt DESC";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
  
    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
    }
// read products with pagination
public function readPaging($from_record_num, $records_per_page){
  
    // select query
    $query = "SELECT
                c.description as category_description, p.id, p.description, p.price, p.category_id, p.createdAt
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    category c
                        ON p.category_id = c.id
            ORDER BY p.createdAt DESC
            LIMIT ?, ?";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
  
    // execute query
    $stmt->execute();
  
    // return values from database
    return $stmt;
    }
// used for paging products
public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    return $row['total_rows'];
    }
}
?>
