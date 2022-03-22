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
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
$quantidade_pg = (isset($_GET['pag']))? $_GET['pag'] : 10;
//Selecionar todos os cursos da tabela
$sql1 = "select * from  produtos ";
$result1 = mysqli_query($connection, $sql1) or die("Error in Selecting " . mysqli_error($connection));


//Contar o total de cursos
$total_cursos = mysqli_num_rows($result1);

//Seta a quantidade de cursos por pagina


//calcular o número de pagina necessárias para apresentar os cursos
$num_pagina = ceil($total_cursos/$quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;
////////////////////////////////////////////////////////
 //fetch table rows from mysql db
 $sql = "select * from  produtos ORDER BY id DESC limit $incio, $quantidade_pg ";
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



