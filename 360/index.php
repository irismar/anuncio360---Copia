<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
    <meta property="og:site_name" content="Anuncio360.com" />
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
    <meta name="twitter:card" content="summary">
<meta name="twitter:creator" content="@Anuncio360.com">
<meta name="twitter:site" content="@Anuncio360.com">
<meta name="twitter:domain" content="Anuncio360.com">
<meta name="twitter:title" content="Anúncio interrativo em fotos 360 graus">
<meta name="twitter:description" content="Anúncio interrativo em fotos 360 graus">
<meta property="og:image" content="https://www.anuncio360.com/img/logo_login.png">
<title>Anuncio 360.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description" content="Anúncio interrativo em fotos 360 graus" />
<meta name="keywords" content="anuncio interativo"/>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">

<meta http-equiv="Content-Language" content="pt-br">
<!--  Infinite scrolling is based on the JQuery library and a custom jquery script , include these files --> 


<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="360/javascript/custom_jquery.js"></script>

<meta name="robots" content="noindex">
 
<style>
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');
</style> 
<link rel="stylesheet" type="text/css"  href="360/styles.css" />



    </head>
    <body>


     <?

session_start();
      include 'topo.php';?>


          <div id="content">
<?php  echo  $aviso_perfil_0;?>
            <div class="article">

<div id="postedComments"   >


</div>
<div id="loadMoreComments" style="display:none;" >   <div class='tipo'><div class='loader2'></div> </div> 
        </div>
        </div>

    </body>
    

   


  
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