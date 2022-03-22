<link rel="stylesheet" type="text/css"  href="../360/styles.css" />
<?php

function distance($lat1, $lon1, $lat2, $lon2) {

    $pi80 = M_PI / 180;
    $lat1 *= $pi80;
    $lon1 *= $pi80;
    $lat2 *= $pi80;
    $lon2 *= $pi80;

    $r = 6372.797; // mean radius of Earth in km
    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $km = $r * $c;

    //echo '<br/>'.$km;
    return  $km;
}

session_start();
include_once './conexao.php';


if($_POST)
{
///$q=$_POST['search-box'];

////var_dump ($_POST);


$q = filter_input(INPUT_POST, 'search-box', FILTER_SANITIZE_STRING);

//SQL para selecionar os registros


if(isset($_GET['perfil'])){


  $id_perfil = filter_input(INPUT_GET, 'perfil', FILTER_SANITIZE_EMAIL);
  

   $result_msg_cont = "SELECT * from produtos where id_anunciante ='$id_perfil' AND descricao like '%$q%'  order by id LIMIT 10";

} else { 


$result_msg_cont = "SELECT * from produtos where nome_anunciante like '%$q%' or descricao like '%$q%' or titulo like '%$q%'  order by id LIMIT 10";
}
//Seleciona os registros
$resultado_msg_cont = $conn->prepare($result_msg_cont);
$resultado_msg_cont->execute();

while($row = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC)){
  
$distancia=distance($_SESSION['lat'], $_SESSION['lng'], $row['lat'], $row['log']);

if($distancia < 1){
        $km= floor( $distancia*1000)." "."metros";
    } else{
    $km=floor($distancia)." "."Km";

}

$id=$row['id'];

$descricao=$row['descricao'];
$nome_anunciante=$row['nome_anunciante'];
$avatar=$row['avatar'];
$id_anunciante=$row['id_anunciante'];
$foto='https://anuncio360.com/web/imagens/'.$row['id_anunciante'].'/'.$row['id'].'/1.jpg';





?>

<div class='user1'>
<div class='info3'> 
                <div class='profile-pic2'><img src=<?=$foto;?> alt='<?=$descricao;?>'></div>
                 <p class='busca'> <a href="https://www.anuncio360.com/<?php echo $id; ?>"><?=$descricao;?></a></p>
                <p class='busca'><?=$nome_anunciante;?></p>

                  <h5 class='busca'> <img src='img/distancia.jpg' class='options' alt=''><?= $km;?></h5>
             

               
             </div>
            
            
 
</div>
      

      

  
  

<?php
}
} 
