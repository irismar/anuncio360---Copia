<?php

//Cabecalhos obrigatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
//header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");

//Incluir a conexao
//Incluir a conexao

$dbname = "360";
$host="mysql873.umbler.com";
$user="360";
$pass="irisMAR100";
$agora = date('Y/m/d H:i:s');

//Conexao com a porta
$conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);

$response_json = file_get_contents("php://input");
$dados = json_decode($response_json, true);

if($dados){

    $query_produto = "INSERT INTO produtos (titulo,categoria,estado,preco ,descricao,id_anunciante,nome_anunciante,avatar,endereco,lat,log,data,telefone) VALUES (:titulo, :categoria,:estado,:preco,:descricao,:id_anunciante,:nome_anunciante,:avatar,:endereco,:lat,:log,:data,:telefone)";
    $cad_produto = $conn->prepare($query_produto);

    $cad_produto->bindParam(':titulo', $dados['produto']['titulo'], PDO::PARAM_STR);
    $cad_produto->bindParam(':categoria', $dados['produto']['categoria'], PDO::PARAM_STR);
    $cad_produto->bindParam(':estado', $dados['produto']['estado'], PDO::PARAM_STR);
    $cad_produto->bindParam(':preco', $dados['produto']['preco'], PDO::PARAM_STR);
    $cad_produto->bindParam(':descricao', $dados['produto']['descricao'], PDO::PARAM_STR);
    $cad_produto->bindParam(':id_anunciante', $dados['produto']['id_anunciante'], PDO::PARAM_STR);
    $cad_produto->bindParam(':nome_anunciante', $dados['produto']['nome'], PDO::PARAM_STR); ////id_anunciante
    $cad_produto->bindParam(':avatar', $dados['produto']['avatar'], PDO::PARAM_STR); ////id_anunciante
    $cad_produto->bindParam(':endereco', $dados['produto']['endereco'], PDO::PARAM_STR); ////id_anunciante
    $cad_produto->bindParam(':lat', $dados['produto']['lat'], PDO::PARAM_STR); ////id_anunciante
    $cad_produto->bindParam(':log', $dados['produto']['log'], PDO::PARAM_STR); ////id_anunciante
    $cad_produto->bindParam(':data', $agora, PDO::PARAM_STR); ////id_anunciante
    $cad_produto->bindParam(':telefone', $dados['produto']['tell'], PDO::PARAM_STR); ////id_anunciante
   
    $cad_produto->execute(); 
    $id_anuncio=$conn->lastInsertId(); // returns last ID
    if($cad_produto->rowCount()){
        $response = [
            "erro" => false,
            "messagem" => "Produto cadastrado sucesso!",
            "id_anuncio"=>$id_anuncio
        ];
    }else{
        $response = [
            "erro" => true,
            "messagem" => "Produto não cadastrado sucesso!"
        ];
    }
    
    
}else{
    $response = [
        "erro" => true,
        "messagem" => "Produto não cadastrado sucesso!"
    ];
}

http_response_code(200);
echo json_encode($response);