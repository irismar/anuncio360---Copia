<?php



function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
  ): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
  }
  $token_R = random_str(12);

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

     $query_produto = "INSERT INTO usuario (usuario,senha,data_cadastro,token,tipo_negocio,endereco,telefone,latitude,longitude,email) VALUES (:usuario,:senha,:data_cadastro,:token,:tipo_negocio,:endereco,:telefone,:latitude,:longitude,:email)";
    $cad_produto = $conn->prepare($query_produto);
    $cad_produto->bindParam(':usuario', $dados['cadastro_usuario']['nome_usuario'], PDO::PARAM_STR);
    $cad_produto->bindParam(':senha', $dados['cadastro_usuario']['senha'], PDO::PARAM_STR);
    $cad_produto->bindParam(':data_cadastro', $agora, PDO::PARAM_STR);
    $cad_produto->bindParam(':token',$token_R, PDO::PARAM_STR);
    $cad_produto->bindParam(':tipo_negocio', $dados['cadastro_usuario']['tipo_negocio'], PDO::PARAM_STR);
    $cad_produto->bindParam(':endereco', $dados['cadastro_usuario']['endereco'], PDO::PARAM_STR);
    $cad_produto->bindParam(':telefone', $dados['cadastro_usuario']['telefone'], PDO::PARAM_STR);
    $cad_produto->bindParam(':longitude', $dados['cadastro_usuario']['longitude'], PDO::PARAM_STR);
    $cad_produto->bindParam(':latitude', $dados['cadastro_usuario']['latitude'], PDO::PARAM_STR);
    $cad_produto->bindParam(':email', $dados['cadastro_usuario']['email'], PDO::PARAM_STR);

    $cad_produto->execute();

    if($cad_produto->rowCount()){
        $response = [
            "erro" => false,
            "messagem" => "Produto cadastrado sucesso!",
            "token" => $token_R

        ];
    }else{
        $response = [
            "erro" => true,
            "messagem" => "Produto não cadastrado sucesso!",
            "token" => " "
        ];
    }
    
    
}else{
    $response = [
        "erro" => true,
        "messagem" => "Produto não cadastrado sucesso!", "token" => " "
    ];
}

http_response_code(200);
echo json_encode($response);