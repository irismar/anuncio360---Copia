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

//Incluir a conexao

$host="mysql873.umbler.com";
$user="360";
$pass="irisMAR100";
$dtb="360";

//Conexao com a porta
$conn = new PDO("mysql:host=$host;dbname=" . $dtb, $user, $pass);

 //open connection to mysql db
 $connection = mysqli_connect("mysql873.umbler.com","360","irisMAR100","360") or die("Error " . mysqli_error($connection));

////////////////////////////////////////////////////////
$senha = (isset($_GET['senha']))? $_GET['senha'] :null;
$usuario= (isset($_GET['user']))? $_GET['user'] : null;

//Selecionar todos os cursos da tabela

////////////////////////////////////////////////////////
 //fetch table rows from mysql db

 if(isset ($_GET['token'])){
  $token= $_GET['token'];
  $sql = "select * from   usuario  WHERE    token='".trim($token)."' ";
 }else{
  $sql = "select * from   usuario  WHERE    usuario='".trim($usuario)."'  ";
 }
 
 $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

 $n= mysqli_num_rows( $result );
 if($n=='1'){
 $emparray = array();
  //create an array
  
  while($row =mysqli_fetch_assoc($result))
  {
   $id=   $row['id'];
   $nome=   $row['usuario'];
   $token=   $row['token'];
   $Foto_perfil=   $row['Foto_perfil'];
   $tipo_negocio=   $row['tipo_negocio'];
   $lat=   $row['latitude'];
   $log=   $row['longitude'];
   $endereco=   $row['endereco'];
   $tell=   $row['telefone'];
  }
  $response = [
    "erro" => false,
    "messagem" => "Login Sucesso !",
    "usuario" =>$nome,
    "id" =>$id,
    "token"=>$token,
    "Foto_perfil"=>$Foto_perfil,
    "tipo_negocio"=>$tipo_negocio,
    "lat"=>$lat,
    "log"=>$log,
    "endereco"=>$endereco,
    "tell"=>$tell
   
    
];

  } else {

    $response = [
      "erro" => true,
      "messagem" => "Erro! Verifique usuario ou senha!",
     
  ];
  }
 
    //Resposta com status 200
    http_response_code(200);

    //Retornar os produtos em formato json
   echo json_encode(  $response );



