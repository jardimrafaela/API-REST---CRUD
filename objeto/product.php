<?php
class Product{
  
    // conexão com o DB e nome da tabela
    private $conn;
    private $table_name = "products";
  
    // Objeto
    public $id;
    public $description;
    public $completed;
    public $price;
    public $createdAt;
    public $updatedAt;
    public $category_id;

    // definindo conexão do DB em variável $db
    public function __construct($db){
        $this->conn = $db;
    }
    
// Criando funções
function read(){

    // Select do DB
    $query = "SELECT *  FROM " . $this->table_name . " ORDER BY  id DESC";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
    }

function create($description, $completed, $price, $createdAt, $updatedAt, $category_id){

    $this->description = description;
    $this->completed = completed;
    $this->price = price;
    $this->createdAt = createdAt;
    $this->updatedAt = updatedAt;
    $this->category_id = category_id;

    // Insert do DB
    $query = "INSERT INTO " . $this->table_name . " (description, completed, price, createdAt, updatedAt, category_id)
        VALUES(
            '".$description."',
            '".$completed."',
            '".$price."',
            '".$createdAt."',
            '".$updatedAt."',
            '".$category_id."'
            )";

    $stmt = $this->conn->prepare($query);

    if($stmt->execute()){
        return true;
        }return false;
    }

function readOne($id){

    $this->id = id;
  
    // Select do DB
    $query = "SELECT   *  FROM " . $this->table_name . " p
            WHERE
                p.id = ". $id ."
            LIMIT
                0,1";

    $stmt = $this->conn->prepare( $query );
    $stmt->execute();

    // retorno
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    // Determinando o valor de cada dado
    $this->id = $row['id'];
    $this->description = $row['description'];
    $this->completed = $row['completed'];
    $this->price = $row['price'];
    $this->createdAt = $row['createdAt'];
    $this->updatedAt = $row['updatedAt'];

    }
function update($id, $description, $completed, $price, $updatedAt, $category_id){

    $this->id = id;
    $this->description = description;
    $this->completed = completed;
    $this->price = price;
    $this->updatedAt = updatedAt;
    $this->category_id = category_id;
    
    // Update no DB
    $query = "UPDATE
                " . $this->table_name . "
            SET
                description = '".$description."',
                price = '".$price."',
                completed = '".$completed."',
                category_id = '".$category_id."',
                updatedAt = '".$updatedAt."' 

            WHERE
                id = '".$id."'";
  
    $stmt = $this->conn->prepare($query);
    
    if($stmt->execute()){
        return true;
        }return false;  
    }

function delete($id){
    
    $this->id = id;

    // Delete do DB
    $query = "DELETE FROM " . $this->table_name . " WHERE id = '".$id."'";
  
    $stmt = $this->conn->prepare($query);
    $this->id=htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(1, $this->id);

    if($stmt->execute()){
        return true;
        }return false;
    }

// search products
/*function search($keywords){
  
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
/*public function readPaging($from_record_num, $records_per_page){
  
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
/*public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    return $row['total_rows'];
    }
*/}
?>
