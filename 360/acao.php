<script type="text/javascript">  async    function log(valor){
      
                                    $.ajax({ 
                                    url: '360/log.php', 
                                    async : true,
                                    type: 'POST', 
                                    data:{"valor" :valor}, 
                                    success: function(data) {                
                                 console.log(valor);  }  }); }
                                



</script><?
session_start();



if(isset($_POST['user']) ){
$host="mysql873.umbler.com";
$user="360";
$pass="irisMAR100";
$dtb="360";
$conn = new PDO("mysql:host=$host;dbname=" . $dtb, $user, $pass);
$connection = mysqli_connect("mysql873.umbler.com","360","irisMAR100","360") or die("Error " . mysqli_error($connection));
////////////////////////////////////////////////////////
$senha = (isset($_POST['senha']))? $_POST['senha'] :null;
$usuario= (isset($_POST['user']))? $_POST['user'] : null;




   $sql = "select * from   usuario  WHERE   usuario='".trim($usuario)."'  AND senha='".trim($senha)."'  LIMIT 1 ";
  $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

   $n= mysqli_num_rows( $result );
  if($n=='1'){
  
  while($row =mysqli_fetch_assoc($result))
  {
 $_SESSION['id']= $id=   $row['id'];
 $_SESSION['nome'] = $nome=   $row['usuario'];
 $_SESSION['token']=  $token=   $row['token'];
 $_SESSION['foto_perfil'] = $Foto_perfil=   $row['Foto_perfil'];
 $_SESSION['tipo_negocio']=  $tipo_negocio=   $row['tipo_negocio'];
 $_SESSION['latitude']=  $lat=   $row['latitude'];
 $_SESSION['longitude']=  $log=   $row['longitude'];
 $_SESSION['endereco']=  $endereco=   $row['endereco'];
 $_SESSION['telefone']=  $tell=   $row['telefone'];
    log('acesso sucesso login   id= <?=$id;?>');
  
 header('Location: https://www.anuncio360.com/adicionar');
exit();
  } } else{
    $_SESSION['erro']= "Verifique usurio e (ou) senha";

    header('Location: https://www.anuncio360.com/entrar');
  }

  
}

/////////////////////codigo para login via Cadastro Token//////////////

if(isset($_GET['token']) ){
$host="mysql873.umbler.com";
$user="360";
$pass="irisMAR100";
$dtb="360";
$conn = new PDO("mysql:host=$host;dbname=" . $dtb, $user, $pass);
$connection = mysqli_connect("mysql873.umbler.com","360","irisMAR100","360") or die("Error " . mysqli_error($connection));
////////////////////////////////////////////////////////

$token= trim($_GET['token']);




  echo  $sql = "select * from   usuario  WHERE   token='".trim($token)."'  LIMIT 1 ";
  $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

 echo  $n= mysqli_num_rows( $result );
  if($n=='1'){
echo "eu sou 1";

  
  while($row =mysqli_fetch_assoc($result))
  {
echo $_SESSION['id']= $id=   $row['id'];
echo $_SESSION['nome'] = $nome=   $row['usuario'];
echo $_SESSION['token']=  $token=   $row['token'];
echo $_SESSION['foto_perfil'] = $Foto_perfil=   $row['Foto_perfil'];
echo $_SESSION['tipo_negocio']=  $tipo_negocio=   $row['tipo_negocio'];
echo $_SESSION['latitude']=  $lat=   $row['latitude'];
echo $_SESSION['longitude']=  $log=   $row['longitude'];
echo $_SESSION['endereco']=  $endereco=   $row['endereco'];
echo $_SESSION['telefone']=  $tell=   $row['telefone'];

 
  
  
 header('Location: https://www.anuncio360.com/adicionar');
exit();
  } }

  
}

///////////////////// fim codigo para login via Cadastro Token//////////////

?>