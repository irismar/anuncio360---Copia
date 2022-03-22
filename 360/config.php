<? 

session_start();



if(isset($_POST['sair'])){

    //Destroy entire session data.

session_destroy();



//redirect page to index.php

header('location:../');







}
if(isset($_POST['atualaizar'])){

   header('Location: https://www.anuncio360.com/360/atualizar.php?code='.$_SESSION['token'].'&&acao=atualizar');
    exit();
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

<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<meta http-equiv="Content-Language" content="pt-br">

<!--  Infinite scrolling is based on the JQuery library and a custom jquery script , include these files --> 

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script type="text/javascript" src="360/javascript/custom_jquery.js"></script>

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



<form action="?acao=wgta" method="post">

        <div  class="cadastro_produto">

                  <input type=submit name="sair" class="salvar" value="sair">
     
</div>
 </form> 



 <form  method="post">

        <div  class="cadastro_produto">
                  
                  <input type=submit name="atualaizar" class="salvar" value="Atualizar Cadastro">
     
</div>
 </form> 
  
    </div>

</body>

</html>

