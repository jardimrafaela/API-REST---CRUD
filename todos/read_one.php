<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// Conexão com o banco e ref ao Objeto
include_once '../config/config.php';
include_once '../objects/product.php';
  
// instanciando Objeto
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$id=$_GET['id'];
$stmt = $product->readOne($id);

if($product->description!=null){
    
    $products_arr=array();

    if (0==$product->completed){
        $product->completed = "SIM";
    }else{
        $product->completed = "NÃO";
        }
    
    $product_arr=array(
        "id" => $product ->id,
        "description" => $product ->description,
        "completed" => $product->completed,
        "createdAt" => $product->createdAt,
        "updatedAt" => $product->updatedAt
    );

    // Código de retorno - 200 OK
    http_response_code(200);
  
    // Dados de "produtos" em json
    echo json_encode($product_arr);

}else{

        // Código de retorno - 404 Not found
        http_response_code(404);
        echo json_encode(array("message" => "Este produto não existe."));
}
?>