

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
                

            });
              
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<?php 
session_start();

if(isset($_POST['acao'])){



  $token_R = $id;


$dbname = "360";
$host="mysql873.umbler.com";
$user="360";
$pass="irisMAR100";
$agora = date('Y/m/d H:i:s');
//Conexao com a porta
$conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);

$tipo_negocio="Produtos";

$tipo_negocio="Produtos";
 $img_path='360/images/foto_perfil/'. $_FILES['foto']['name'];
 $img_pathComplete='https://anuncio360.com/360/images/foto_perfil/'.$token_R.'.jpg';

  if(move_uploaded_file($_FILES['foto']['tmp_name'],$img_path )){

    require("360/lib/WideImage.php");
                 $image = WideImage::load( $img_path);
                 $resized = $image->resize('80','80', 'inside'); 
               
                    echo"até aqui";
                $resized->saveToFile('projeto/foto_perfil/'.$token_R.'.jpg');  
                    echo"até aqui2";
                unlink($img_path );
  }  else{
  	echo "erro ao processar Foto";
  }




    $query_produto = "INSERT INTO usuario (usuario,senha,data_cadastro,token,tipo_negocio,endereco,telefone,latitude,longitude,email,Foto_perfil) VALUES (:usuario,:senha,:data_cadastro,:token,:tipo_negocio,:endereco,:telefone,:latitude,:longitude,:email,:Foto_perfil)";
    $cad_produto = $conn->prepare($query_produto);
    $cad_produto->bindParam(':usuario', $_POST['user_url'], PDO::PARAM_STR);
    $cad_produto->bindParam(':senha', $token_R, PDO::PARAM_STR);
    $cad_produto->bindParam(':data_cadastro', $agora, PDO::PARAM_STR);
    $cad_produto->bindParam(':token',$token_R, PDO::PARAM_STR);
    $cad_produto->bindParam(':tipo_negocio',$tipo_negocio, PDO::PARAM_STR);
    $cad_produto->bindParam(':endereco', $_POST['city2'], PDO::PARAM_STR);
    $cad_produto->bindParam(':telefone', $_POST['telefone'], PDO::PARAM_STR);
    $cad_produto->bindParam(':longitude', $_POST['long'], PDO::PARAM_STR);
    $cad_produto->bindParam(':latitude', $_POST['lat'], PDO::PARAM_STR);
    $cad_produto->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $cad_produto->bindParam(':Foto_perfil', $img_pathComplete, PDO::PARAM_STR);

    $cad_produto->execute();

    if($cad_produto->rowCount()){
    	

            header('Location: https://www.anuncio360.com/360/acao.php?token='.$token_R);
        
} } 

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

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<meta http-equiv="Content-Language" content="pt-br">
<!--  Infinite scrolling is based on the JQuery library and a custom jquery script , include these files --> 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">

<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>           
<style>
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');
</style> 
<link rel="stylesheet" type="text/css"  href="/360/styles.css" />
    </head>
    <body>
     <? include '360/topo.php';?>
          <div class="caixa_centro">

<form  method="post" enctype="multipart/form-data">
      <div  class="cadastro_produto">
    
 <div class="login">    
 <div class="topo_nome_login"> <label>Nome Do Sua Marca Empresa ou Loja </label></label> <input type="text" name="usuario" id="usuario" class="search-box_cadastro"  placeholder="Nome da Sua Marca Empresa ou Loja"> </div> 
 <div class="topo_url_cadastro" id='url'></div>

 <div class="topo_url_resposta" id='resposta'></div>

 <div class="topo_nome_login"> <label>Endereço</label></label> <input id="searchTextField" type="text" name="titulo" class="search-box_cadastro"  placeholder="Endereço"> </div> 
 <div class="pac-container pac-logo"></div>


 <input type="hidden" id="city2" name="city2" />
 <input type="hidden" id="cityLat" name="lat" />
 <input type="hidden" id="cityLng" name="long" />
 <input type="hidden" id="user_url" name="user_url">

 <div class="topo_nome_login"> <label>Whatapp </label></label> <input type="tel" id="telefone" name="telefone" class="search-box_cadastro telefone "  placeholder="Whatapp"> </div> 

 <div class="topo_nome_login"> <label>E-mail </label></label> <input type="emil" name="email" id="enail" class="search-box_cadastro"  value="<?php echo $email;?>" placeholder="Email"> </div> 


 
 <div class="topo_nome_login"> <label>Escolher outra Foto   </label></label> <input type="file" name="foto" id="foto" class="search-box_cadastro" required placeholder="Foto"> </div> 



 <div class="topo_nome_login"> 
 
      </div> 


     
     
    

       

               
            

              <? if(isset($erro)){ ?>
                    <div class="caixa_erro_login"><a href="#"><?php echo $erro;?></a></div>

                    
             <? } ?>
                 
                
                 
 <input type=submit style="display:none;" name="acao" class="salvar" id="salvar" value="Cadastrar">
                


                 

</div>



      </div>

 </form> 
    </div>

</body>
</html>

  
  <script type="text/javascript">
    $('.telefone').mask('(##) #####-####', {reverse: true});
   
 </script>
           
<script language="javascript">
      

   
 
            
function removerAcento(s) {
    return s.normalize('NFD')
        .replace(/[\u0300-\u036f]/g, "")
        .toLowerCase()
       .replace(/[!@#$%¨&*()_+[}}/;/?\|'".,']/g, "")
        .replace(/ +/g, "-")
        .replace(/-{2,}/g, "-");
}

    var url = $("#usuario"); 
   url.on('keyup', function(){
   var  valor=url.val();

        var url_nova;
        url_nova=removerAcento(valor);
       
   document.getElementById('user_url').value = url_nova;

    $("#url").text("www.anuncio360.com/"+url_nova);



    });


          var usuario = $("#usuario");
        usuario.blur(function() { 
            $.ajax({ 
                url: 'https://www.anuncio360.com/360/verificar_user.php', 
                type: 'POST', 
                data:{"usuario" :usuario.val()}, 
                success: function(data) { 
               
                data = $.parseJSON(data); 
                $("#resposta").text(data.usuario);
                 
                var resposta= data.usuario;
                
                if(resposta==='OK'){

                  console.log(resposta); 
                    document.getElementById('salvar').style.display ="inline";
                }



            } 
        }); 
    }); 
</script>