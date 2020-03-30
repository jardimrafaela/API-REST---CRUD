<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
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
$datetime=new DateTime();

// criando o produto
if(
    $product->create(
    $data->description,
    $data->completed,
    $datetime->format('Y\-m\-d\ H:i:s'),
    $datetime->format('Y\-m\-d\ H:i:s'),
    $data->category_id)
    ){
                          
        // Código de retorno - 200 OK
        http_response_code(200);
        echo json_encode(array("message" => "Produto criado com sucesso"));

    }else{
              
        // Código de retorno - 404 Not found
        http_response_code(400);
        echo json_encode(array("message" => "Não foi possível criar o produto, verifique se os dados estão completos."));
    }
?>