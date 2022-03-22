<?php

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
$id = $_GET['id'] ;


////////////////////////////////////////////////////////
 //fetch table rows from mysql db
 $sql = "select   pasta from  whare id='$id' produto360 ORDER BY id DESC limit 1  ";
 $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));


$emparray = array();
  //create an array
  $emparray = array();
  while($row =mysqli_fetch_assoc($result))
  {
      $emparray[] = $row;
  }
 
    //Resposta com status 200
    http_response_code(200);

    //Retornar os produtos em formato json
    echo json_encode($emparray);



