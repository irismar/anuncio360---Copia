<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
    
   <title>Anuncio360.com/<?php echo $getid;?></title>
    <meta property="og:site_name" content="Anuncio360.com/<?php echo $getid;?>">
    <meta property="og:title" content="Anuncio360.com/<?php echo $getid;?>">
    <meta property="og:description" content="Anuncio360.com/<?php echo $getid;?>  <?=$descricao?>">

    <meta property="og:image" content="https://anuncio360.com/web/imagens/<?=$id_anunciante;?>/<?php echo $getid;?>/1.jpg">
<meta property="og:image:type" content="image/jpg">
<meta property="og:image:width" content="800">
<meta property="og:image:height" content="600">
    <meta property="og:image" itemprop="image" content="https://anuncio360.com/web/imagens/<?=$id_anunciante;?>/<?php echo $getid;?>/2.jpg">
    <link itemprop="thumbnailUrl" href="https://anuncio360.com/web/imagens/<?=$id_anunciante;?>/<?php echo $getid;?>/1.jpg"> 
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:updated_time" content="updatedtime">
    <meta property="og:locale" content="pt-br" />
    <meta property="og:url" content="https://anuncio360.com/<?=$getid;?>">
    <meta property="og:type" content="website" />
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description" content="Anuncio360.com/<?php echo $getid;?>  <?=$descricao?>" />

  <meta name="twitter:card" content="summary">
<meta name="twitter:creator" content="@Anuncio360.com/<?php echo $getid;?>">
<meta name="twitter:site" content="@Anuncio360.com/<?php echo $getid;?>">
<meta name="twitter:domain" content="Anuncio360.com/<?php echo $getid;?>">
<meta name="twitter:title" content="Anuncio360.com/<?php echo $getid;?>  <?=$descricao?>">
<meta name="twitter:description" content="Anuncio360.com/<?php echo $getid;?>  <?=$descricao?>">
<meta property="og:image" content="https://anuncio360.com/web/imagens/<?=$id_anunciante;?>/<?php echo $getid;?>/2.jpg">

<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="Content-Language" content="pt-br">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="../novo360/pdt360DegViewer.js"></script>
<script type="text/javascript" src="../360/javascript/produto.js"></script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');
</style> 
<link rel="stylesheet" type="text/css"  href="../360/styles.css" />
<meta name="robots" content="noindex">
    </head>
    <body>
    <div class='id_anuncio' id="<?php echo $getid;?>"></div>
    <div id="exibir">    
       <? include 'topo.php';?>
          <div id="content">
<?php  echo  $aviso_perfil_0;?>
            <div class="article">

<div id="postedComments"   >

<!--  Include the following PHP include line to start the infinite scrolling functionality  -->
<?php  ///
/////require_once '360/carregar_produto.php' ;  ?> 
</div>
<div id="loadMoreComments" style="display:none;" >   <div class='tipo'><div class='loader'></div> </div> 
        
                          
            </div>     
            
            

            
        </div>

    </body>
    

   


   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery-1.8.0.js"></script>
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
    data: dataString,
    cache: false,
    success: function(html)
    {
    $("#result").html(html).show();
    }
    });
}return false;    
});

jQuery("#result").live("click",function(e){ 
    var $clicked = $(e.target);
    var $name = $clicked.find('.name').html();
    var decoded = $("<div/>").html($name).text();
    $('#searchid').val(decoded);
});
jQuery(document).live("click", function(e) { 
    var $clicked = $(e.target);
    if (! $clicked.hasClass("search")){
    jQuery("#result").fadeOut(); 
    }
});
$('#searchid').click(function(){
    jQuery("#result").fadeIn();
});
});



   /////////////////////////////////////////////////////////

  
$(window).scroll(function(){
        
        
        if($(document).scrollTop() > 200){// se a rolagem passar de 200px esconde o elemento
        
            $('#exibir').fadeOut(); // Esconde usando fadeOut
            
        } else { // senão ele volta a ser visivel
        
            $('#exibir').fadeIn(); // Mostra usando fadeIn
            
        }
        
    });


</script>   
</html>