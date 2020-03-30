<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// Conexão com o banco e ref ao Objeto
include_once '../config/config.php';
include_once '../objects/product.php';
  
// instanciando Objeto 
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$datetime=new DateTime(); 
$data = json_decode(file_get_contents("php://input"));

// update do produto  
if($product->update(
    $data->id,
    $data->description,
    $data->completed,
    $datetime->format('Y\-m\-d\ H:i:s')
    )){
  
        // Este produto existe.- 200 ok
        http_response_code(200);
        echo json_encode(array("message" => "Produto foi atualizado"));
        
    }else{

    // Este produto não existe.- 503 service unavailable
    http_response_code(503);
    echo json_encode(array("message" => "Produto não foi atualizado."));
    }
?>
