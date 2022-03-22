<?php  session_start();   




error_reporting(0);
set_exception_handler('exception_handler') ;
$config = parse_ini_file("config/my.ini") ;
$db=new mysqli($config['dbLocation'] , $config['dbUser'] , $config['dbPassword'] , $config['dbName']);
if(mysqli_connect_error()) {
 throw new Exception("<b>Could not connect to database</b>") ;
}


if(isset($_POST['token'])){

//var_dump($_POST);

$conexao = new PDO("mysql:host=mysql873.umbler.com; dbname=360", "360", "irisMAR100");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexao->exec("set names utf8");   
        echo $token=trim($_POST['token']);
        echo $titulo=trim($_POST['titulo']);
        echo $preco=trim($_POST['preco']);
        echo $id=trim($_POST['id']);
        $stmt = $conexao->prepare('UPDATE produtos  SET  titulo=:titulo,descricao=:descricao,preco=:preco  WHERE code= :code');
                 $stmt->execute(array( ':code'=>$token, 
                    ':titulo'=>$titulo,
                    ':descricao'=>$descricao,
                    ':preco'=>$preco
                     )); 

        header('Location: https://www.anuncio360.com/'.$id);         


exit();
}    

 $token= filter_input(INPUT_GET, "id", FILTER_SANITIZE_URL);
 $id_anunciante=$_SESSION['id'];
 $busca="SELECT * FROM produtos WHERE   code='$token'   AND id_anunciante='$id_anunciante'  ORDER BY id DESC LIMIT 1";
$result = $db->query($busca);
 
while ($data = $result->fetch_object()) {
$id=$data->id;


$titulo=$data->titulo;
$id_anunciante=$data->id_anunciante;
$preco=$data->preco;
$descricao=$data->descricao;
} ?>

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

<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>           
<style>
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');
</style> 
<link rel="stylesheet" type="text/css"  href="../360/styles.css" />
    </head>
    <body>
    
          <div class="caixa_centro">
<div class="caixa_centro">
<img   src="https://anuncio360.com/web/imagens/<?=$id_anunciante;?>/<?=$id;?>/1.jpg">
</div>
<form action="#" method="post">
    	<div  class="cadastro_produto">
   	
 <div class="login">   	
 <div class="topo_nome_login"> <label>Titulo Anuncio</label></label> <input type="text" value="<?=$titulo;?>" name="titulo" class="search-box_cadastro"  placeholder="Nome Usuario"> </div> 

     <div class="topo_nome_login"> <label>Tipo Anúncio</label></label> 
     <select class="search-box_cadastro" name="categoria">
<option value="eltronicos">Eletrônicos</option>
<option value="roupas">Roupa</option>
<option value="acessorios_moda">Acessrios Moda</option>
<option value="comida">Comida</option>
<option value="Brinquedos">Brinquedos</option>
</select>
      </div> 
<input type="hidden" value="<?=$token;?>" name="token">
<input type="hidden" value="<?=$id;?>" name="id">

     <div class="topo_nome_login"> <label>Estado</label>
     <select class="search-box_cadastro" name="estado">
<option value="novo">Novo</option>
<option value="usado">Usado</option>
</select>
     </div> 
     
      <div class="topo_nome_login"> <label>Preço</label></label> <input type="tel" value="<?=$preco;?> id="preco" value="" name="preco" class="search-box_cadastro dinheiro "  placeholder="Nome Usuario"> </div> 

       <div class="topo_nome_login"> <label>Descrição</label></label> <input type="text"  id="w3review"  value="<?=$descricao;?>" name="descricao" multi-row  class="search-box_text_area" >
</div> 

       <script type="text/javascript">
    $('.dinheiro').mask('0.000.000.000,00', {reverse: true});
   
 </script>
               
            

                 
                
                 
                  <input type=submit name="atualizar" class="salvar" value="Atualizar">
                


                 

</div>




    	</div>

 </form> 
    </div>

</body>
</html>

