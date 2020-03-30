<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// Conexão com o banco e ref ao Objeto
include_once '../config/config.php';
include_once '../objects/product.php';
  
// instanciando Objeto 
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$stmt = $product->read();
$num = $stmt->rowCount();
  
if($num>0){

    $products_arr=array();
    $products_arr["Display produtos"]=array();
  
    // devolutiva do conteúdo
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      
        extract($row);

        if (0==$completed){
            $completed = "Não";
        }else{
            $completed = "Sim";
        }

        $product_item=array(
            "id" => $id,
            "description" => $description,
            "completed" => $completed,
            "createdAt" => $createdAt,
            "updatedAt" => $updatedAt
        );
  
        array_push($products_arr["Display produtos"], $product_item);
    }
  
    // Código de retorno - 200 OK
    http_response_code(200);
  
    // Dados de "produtos" em json
    echo json_encode($products_arr);

}else{
  
    // Código de retorno - 404 Not found
    http_response_code(404);
    echo json_encode(array("message" => "Nenhum produto encontrado."));
}
?>