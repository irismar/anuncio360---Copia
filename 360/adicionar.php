<? 
session_start();
if(isset($_SESSION['id'])){ 
if(isset($_POST['acao'])){
var_dump($_SESSION);
var_dump($_POST);
$dbname = "360";
$host="mysql873.umbler.com";
$user="360";
$pass="irisMAR100";
$agora = date('Y/m/d H:i:s');

//Conexao com a porta
$conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);
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
$code = random_str(12);
///$codeurl='https://anuncio360.com/projeto/galeria360.php?code='.$code;
    $query_produto = "INSERT INTO produtos (titulo,categoria,estado,preco ,descricao,id_anunciante,nome_anunciante,avatar,endereco,lat,log,data,telefone,code) VALUES (:titulo, :categoria,:estado,:preco,:descricao,:id_anunciante,:nome_anunciante,:avatar,:endereco,:lat,:log,:data,:telefone,:code)";
    $cad_produto = $conn->prepare($query_produto);

    $cad_produto->bindParam(':titulo', $_POST['titulo'], PDO::PARAM_STR);
    $cad_produto->bindParam(':categoria', $_POST['categoria'], PDO::PARAM_STR);
    $cad_produto->bindParam(':estado', $_POST['estado'], PDO::PARAM_STR);
    $cad_produto->bindParam(':preco', $_POST['preco'], PDO::PARAM_STR);
    $cad_produto->bindParam(':descricao', $_POST['descricao'], PDO::PARAM_STR);
    $cad_produto->bindParam(':id_anunciante', $_SESSION['id'], PDO::PARAM_STR);
    $cad_produto->bindParam(':nome_anunciante', $_SESSION['nome'], PDO::PARAM_STR); ////id_anunciante
    $cad_produto->bindParam(':avatar', $_SESSION['foto_perfil'], PDO::PARAM_STR); ////id_anunciante
    $cad_produto->bindParam(':endereco', $_SESSION['endereco'], PDO::PARAM_STR); ////id_anunciante
    $cad_produto->bindParam(':lat', $_SESSION['latitude'], PDO::PARAM_STR); ////id_anunciante
    $cad_produto->bindParam(':log', $_SESSION['longitude'], PDO::PARAM_STR); ////id_anunciante
    $cad_produto->bindParam(':data', $agora, PDO::PARAM_STR); ////id_anunciante
    $cad_produto->bindParam(':telefone', $_SESSION['telefone'], PDO::PARAM_STR); ////id_anunciante
    $cad_produto->bindParam(':code', $code, PDO::PARAM_STR); ////id_anunciante
    //$cad_produto->bindParam(':urlcode', $codeurl, PDO::PARAM_STR); ////id_anunciante
    $cad_produto->execute(); 
    $id_anuncio=$conn->lastInsertId(); // returns last ID
    if($cad_produto->rowCount()){
    
     $codeurl='https://anuncio360.com/novo360/index.php?id='.$_SESSION['id'].'&&id_anuncio='.$id_anuncio;
        $stmt = $conn->prepare('UPDATE produtos  SET urlcode="'.$codeurl.'" WHERE id= :id');
        $stmt->execute(array( ':id'=>$id_anuncio ));  

 
          header('Location: https://anuncio360.com/web/index.html?id='.$_SESSION['id'].'&&code='.$code.'&&anuncio='.$id_anuncio);

    	echo "tudo certo jão";
    }else{
        $erro ="erro ao cadastrar produto Tente Novamente";
    }
    

}

	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
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
<script type="text/javascript" src="360/javascript/custom_jquery.js"></script>
<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>           
<style>
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');
</style> 
<link rel="stylesheet" type="text/css"  href="360/styles.css" />
    </head>
    <body>
     <? include 'topo.php';?>
          <div class="caixa_centro">

<form action="?acao=cadastro" method="post">
    	<div  class="cadastro_produto">
   	
 <div class="login">   	
 <div class="topo_nome_login"> <label>Titulo Anuncio</label></label> <input type="text" name="titulo" class="search-box_cadastro"  placeholder="Nome Usuario"> </div> 

     <div class="topo_nome_login"> <label>Tipo Anúncio</label></label> 
     <select class="search-box_cadastro" name="categoria">
<option value="eltronicos">Eletrônicos</option>
<option value="roupas">Roupa</option>
<option value="acessorios_moda">Acessrios Moda</option>
<option value="comida">Comida</option>
<option value="Brinquedos">Brinquedos</option>
</select>
      </div> 


     <div class="topo_nome_login"> <label>Estado</label>
     <select class="search-box_cadastro" name="estado">
<option value="novo">Novo</option>
<option value="usado">Usado</option>
</select>
     </div> 
     
      <div class="topo_nome_login"> <label>Preço</label></label> <input type="tel" id="preco" name="preco" class="search-box_cadastro dinheiro "  placeholder="Nome Usuario"> </div> 

       <div class="topo_nome_login"> <label>Descrição</label></label> <textarea id="w3review" name="descricao"  class="search-box_text_area" >
</textarea></div> 

       <script type="text/javascript">
    $('.dinheiro').mask('0.000.000.000,00', {reverse: true});
   
 </script>
               
            

              <? if(isset($erro)){ ?>
                    <div class="caixa_erro_login"><a href="#"><?php echo$erro;?></a></div>

                    
             <? } ?>
                 
                
                 
                  <input type=submit name="acao" class="salvar" value="Cadastrar">
                


                 

</div>



    	</div>

 </form> 
    </div>

</body>
</html>


<?

	
} else{echo 'eu não esou logado';
header('Location: https://www.anuncio360.com/entrar');
} ?>
</body>
</html>
 <script>





   $(function(){
$(".search-box").keyup(function() 
{ 
var searchid = $(this).val();
var dataString = 'search-box='+ searchid;
if(searchid!='')
{
    $.ajax({
    type: "POST",
    url: "../busca/proc_pesq_msg.php",  
    async : true,
    data: dataString,
    cache: false,
    success: function(html)
    {
    $("#result").html(html).show();
    }
    });
}return false;    
});



$('#searchid').click(function(){
    jQuery("#result").fadeIn();
});
});



   /////////////////////////////////////////////////////////

  
$(window).scroll(function(){
        
        
        if($(document).scrollTop() > 600){// se a rolagem passar de 200px esconde o elemento
        
            $('#exibir').fadeOut(); // Esconde usando fadeOut
            
        } else { // senão ele volta a ser visivel
        
            $('#exibir').fadeIn(); // Mostra usando fadeIn
            
        }
        
    });


</script>   
</html>