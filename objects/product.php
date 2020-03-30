<?php
class Product{
  
    // conexão com o DB e nome da tabela
    private $conn;
    private $table_name = "products";
  
    // Objeto
    public $id;
    public $description;
    public $completed;
    public $createdAt;
    public $updatedAt;

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

function create($description, $completed, $createdAt, $updatedAt){

    $this->description = description;
    $this->completed = completed;
    $this->createdAt = createdAt;
    $this->updatedAt = updatedAt;

    // Insert do DB
    $query = "INSERT INTO " . $this->table_name . " (description, completed, createdAt, updatedAt)
        VALUES(
            '".$description."',
            '".$completed."',
            '".$createdAt."',
            '".$updatedAt."'
            )";

    $stmt = $this->conn->prepare($query);

    if($stmt->execute()){
        return true;
        }return false;
    }

/*function readOne($id){

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
    $this->createdAt = $row['createdAt'];
    $this->updatedAt = $row['updatedAt'];

    }*/
function update($id, $description, $completed, $updatedAt){

    $this->id = id;
    $this->description = description;
    $this->completed = completed;
    $this->updatedAt = updatedAt;
    
    // Update no DB
    $query = "UPDATE
                " . $this->table_name . "
            SET
                description = '".$description."',
                completed = '".$completed."',
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

}
?>