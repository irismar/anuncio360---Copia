<html>
<head>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTCJwwUlXn00DQX19Tr89S6hfEERGxaNg&libraries=places"></script>
    <script>




        function initialize() {
          var input = document.getElementById('searchTextField');
          var options ={ componentRestrictions: {country: "br"} ,types: ['geocode']
          ,fields: ["formatted_address", "geometry"]
      };

          var autocomplete = new google.maps.places.Autocomplete(input,options);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                const place = autocomplete.getPlace();
                document.getElementById('city2').value = place.formatted_address;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
                 console.log(place);

            });
              
        }
        google.maps.event.addDomListener(window, 'load', initialize);


         function log(valor){
      
                                    $.ajax({ 
                                    url: '360/log.php', 
                                    type: 'POST', 
                                    data:{"valor" :valor}, 
                                    success: function(data) {                
                                 console.log('ok tudo certo');  }  }); }
    </script>
<?php
session_start();

$host="mysql873.umbler.com";
$user="360";
$pass="irisMAR100";
$dtb="360";
$conn = new PDO("mysql:host=$host;dbname=" . $dtb, $user, $pass);
$connection = mysqli_connect("mysql873.umbler.com","360","irisMAR100","360") or die("Error " . mysqli_error($connection));
////////////////////////////////////////////////////////
if(isset($_POST['acao'])){
        $conexao = new PDO("mysql:host=mysql873.umbler.com; dbname=360", "360", "irisMAR100");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexao->exec("set names utf8");    
        //var_dump($_POST);
        $email=trim($_POST['email']);
        $endereco=trim($_POST['city2']);

        $id=trim($_POST['id']);
        $lat=trim($_POST['lat']);
        $long=trim($_POST['long']);
        $telefone=trim($_POST['telefone']);
        $id=trim($_POST['id']);
        $token=trim($_POST['token']);
        if($_FILES['foto']){

          echo $img_path='images/foto_perfil/'. $_FILES['foto']['name'];
          echo $img_pathComplete='https://anuncio360.com/projeto/foto_perfil/'.$token.'.jpg';
          unlink('../projeto/foto_perfil/'.$token.'.jpg' );
         if(move_uploaded_file($_FILES['foto']['tmp_name'],$img_path )){

         require("lib/WideImage.php");
                $image = WideImage::load( $img_path);
                $resized = $image->resize('80','80', 'inside'); 
               
                    
                $resized->saveToFile('../projeto/foto_perfil/'.$token.'.jpg');  
                unlink($img_path );
  }  


            var_dump( $_FILES['foto']);
                 $stmt = $conexao->prepare('UPDATE usuario  SET 
                             email=:email,
                             latitude=:latitude,
                             longitude=:longitude,
                             telefone=:telefone,
                             Foto_perfil=:Foto_perfil,
                             endereco=:endereco

                              WHERE id= :id');
        $stmt->execute(array( ':id'=>$id, 
                              ':email'=>$email,
                              ':latitude'=>$lat,
                              ':longitude'=>$long,
                              ':telefone'=>$telefone,
                              ':Foto_perfil'=>$img_pathComplete,
                              ':endereco'=>$endereco
                          )); 
                 $stmt = $conexao->prepare('UPDATE produtos  SET  lat=:lat, log=:log,endereco=:endereco  WHERE id_anunciante= :id_anunciante');
                 $stmt->execute(array( ':id_anunciante'=>$id, 
                    ':lat'=>$lat,
                    ':log'=>$long,
                    ':endereco'=>$endereco )); 
               
                   header('Location: https://www.anuncio360.com/360/acao.php?token='.$token);
exit();
        } else{ 


        $stmt = $conexao->prepare('UPDATE usuario  SET 
                             email=:email,
                             latitude=:latitude,
                             longitude=:longitude,
                             telefone=:telefone

                              WHERE id= :id');
        $stmt->execute(array( ':id'=>$id, 
                              ':email'=>$email,
                              ':latitude'=>$lat,
                              ':longitude'=>$long,
                              ':telefone'=>$telefone
                          )); 
           $stmt = $conexao->prepare('UPDATE produtos  SET  lat=:lat, log=:log  WHERE id_anunciante= :id_anunciante');
                 $stmt->execute(array( ':id_anunciante'=>$id, 
                    ':lat'=>$lat,
                    ':log'=>$long ));   
               
                     header('Location: https://www.anuncio360.com/360/acao.php?token='.$token);                       
        
exit();
} }




$code =trim( (isset($_GET['code']))? $_GET['code'] :null);
///////verificar se CODE === Sessiom//////////////////////

if(isset($_SESSION['token'])&&($_SESSION['token']==$code)){ 
     $sql = "select * from   usuario  WHERE   token='".trim($code)."'  LIMIT 1 ";
  $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

   $n= mysqli_num_rows( $result );
  if($n=='1'){
  
  while($row =mysqli_fetch_assoc($result))
  {
 $_SESSION['id']= $id=   $row['id'];

 
 $_SESSION['nome'] = $nome=   $row['usuario'];
 $_SESSION['token']=  $token=   $row['token'];
 $email=$row['email'];
 $senha=$row['senha'];
 $_SESSION['foto_perfil'] = $Foto_perfil=   $row['Foto_perfil'];
 $_SESSION['tipo_negocio']=  $tipo_negocio=   $row['tipo_negocio'];
 $_SESSION['latitude']=  $lat=   $row['latitude'];
 $_SESSION['longitude']=  $log=   $row['longitude'];
 $_SESSION['endereco']=  $endereco=   $row['endereco'];
 $_SESSION['telefone']=  $tell=   $row['telefone']; 

} } } else{
    echo "Erro Crítico sair";
    exit();
}
  ?>
 <head>
 <meta property="og:site_name" content="sitename" />
 <meta property="og:title" content="Anuncio360">
 <meta property="og:description" content="Anúncio interrativo em fotos 360 graus">
 <meta property="og:image" itemprop="image" content="https://www.anuncio360.com/img/logo_login.png">
 <link itemprop="thumbnailUrl" href="https://www.anuncio360.com/img/logo_50.png"> 
 <meta property="og:image:type" content="image/png">
 <meta property="og:updated_time" content="updatedtime">
 <meta property="og:locale" content="pt-br" />
 <meta property="og:url" content="https://anuncio360.com">
 <meta property="og:type" content="website" />
 <meta property="og:image:width" content="300" />
 <meta property="og:image:height" content="300" />   
<title>Anuncio 360.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description" content="Anúncio interrativo em fotos 360 graus" />
<meta name="keywords" content="anuncio interativo"/>
<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<meta http-equiv="Content-Language" content="pt-br">
<!--  Infinite scrolling is based on the JQuery library and a custom jquery script , include these files --> 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>           
<style>
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');
</style> 
<link rel="stylesheet" type="text/css"  href="../360/styles.css" />
    </head>
    <body>
     <? include 'topo.php';?>
          <div class="caixa_centro">

<form action="?acao=cadastro" method="post" enctype="multipart/form-data">
      <div  class="cadastro_produto">
    
 <div class="login">    
 <div class="topo_nome_login"> <label>Para Alterar seu nome de usuario envie email para supote@anuncio360.com </label></label> <input type="text" name="usuario" id="usuario" class="search-box_cadastro"   value="<?=$nome;?>" placeholder="Nome da Sua Marca Empresa ou Loja" disabled> </div> 
 <div class="topo_url_cadastro" id='url'></div>

 <div class="topo_url_resposta" id='resposta'></div>

 <div class="topo_nome_login"> <label>Endereço</label></label> <input id="searchTextField" type="text" name="titulo" class="search-box_cadastro"  value="<?=$endereco;?>"placeholder="Endereço"> </div> 
 <div class="pac-container pac-logo"></div>


 <input type="hidden" value="<?=$endereco;?>" id="city2" name="city2" />
 <input type="hidden" value="<?=$lat;?>"id="cityLat" name="lat" />
 <input type="hidden" value="<?=$log;?>"id="cityLng" name="long" />
 <input type="hidden" id="user_url" name="user_url">
 <input type="hidden" id="id" value="<?=$id;?>" name="id">
 <input type="hidden" id="token" value="<?=$token;?>" name="token">

  <div class="topo_nome_login"> <label>Whatapp </label></label> <input type="tel" id="telefone" name="telefone" class="search-box_cadastro telefone "  value="<?=$tell;?>"  placeholder="Whatapp"> </div> 

 <div class="topo_nome_login"> <label>E-mail </label></label> <input type="emil" name="email" id="enail" class="search-box_cadastro" value="<?=$email;?>"  placeholder="E-mail"> </div> 


 <div class="topo_nome_login"> <label>Senha </label></label> <input type="password" name="senha" id="senha" class="search-box_cadastro"  value="<?=$senha;?> placeholder="Senha"> </div> 


 <div class="topo_nome_login"> <label>Selecione Foto Apenas se quiser subistituir a atual   </label>
    <img width="30%" src="<?=$Foto_perfil;?>">  <input type="file" name="foto" id="foto" class="search-box_cadastro"   placeholder="Foto"> </div> 



 <div class="topo_nome_login"> 
 
      </div> 


     
     
    

       

               
            

              <? if(isset($erro)){ ?>
                    <div class="caixa_erro_login"><a href="#"><?php echo$erro;?></a></div>

                    
             <? } ?>
                 
                
                 
                  <input type=submit  name="acao" class="salvar" id="salvar" value="Atualizar">
                


                 

</div>



      </div>

 </form> 
    </div>

</body>
</html>

  <script type="text/javascript">
    $('.telefone').mask('(##) #####-####', {reverse: true});
   
 </script>
           
