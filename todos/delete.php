<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// Conexão com o banco e ref ao Objeto
include_once '../config/config.php';
include_once '../objects/product.php';
  
// instanciando Objeto
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$data = json_decode(file_get_contents("php://input"));
$id=$_GET['id']; 

// Deletando o produto
if($product->delete($id)){
  
    // Código de retorno - 200 OK
    http_response_code(200);
    echo json_encode(array("message" => "Product was deleted."));

}else{
  
    // Código de retorno - 503 service unavailable
    http_response_code(503);
    echo json_encode(array("message" => "Unable to delete product."));
}
?>
