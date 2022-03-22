<?


if( isset ($_GET['id'])){

$token=trim($_GET['id']);


$host="mysql873.umbler.com";
$user="360";
$pass="irisMAR100";
$dtb="360";

//Conexao com a porta
$conn = new PDO("mysql:host=$host;dbname=" . $dtb, $user, $pass);

 //open connection to mysql db
 $connection = mysqli_connect("mysql873.umbler.com","360","irisMAR100","360") or die("Error " . mysqli_error($connection));



 
 echo  $sql = "select * from   usuario  WHERE    token='".trim($token)."' LIMIT 1 ";

$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

 echo  $n= mysqli_num_rows( $result );
 if($n=='1'){


 $emparray = array();
  //create an array
  
  while($row =mysqli_fetch_assoc($result))
  {
    session_start();
 $_SESSION['id']= $id=   $row['id'];
 $_SESSION['nome'] = $nome=   $row['usuario'];
 $_SESSION['token']=  $token=   $row['token'];
  $_SESSION['foto_perfil'] = $Foto_perfil=   $row['Foto_perfil'];
 $_SESSION['tipo_negocio']=  $tipo_negocio=   $row['tipo_negocio'];
 $_SESSION['latitude']=  $lat=   $row['latitude'];
 $_SESSION['longitude']=  $log=   $row['longitude'];
 $_SESSION['endereco']=  $endereco=   $row['endereco'];
 $_SESSION['telefone']=  $tell=   $row['telefone'];
  }
  
 header('Location: https://www.anuncio360.com');
exit();


 } else {  

echo "direcionar para cadastro";

$id=$_GET['id'];
$nome=$_GET['nome'];
$foto_perfil=$_GET['foto_perfil'];
$email=$_GET['email'];
 header('Location: https://www.anuncio360.com/cadastro-google/'.$id.'/'.$nome.'/'.$email.'&&foto='.$foto_perfil);
exit();


 } } ?>
