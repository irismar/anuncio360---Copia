




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
   <head>
<title>Anuncio360.com</title>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description" content="Infinite Scrolling with Ajax PHP and JQuery" />
<meta name="keywords" content="jquery, Ajax, PHP, Infinite scrolling"/>
<!--  Infinite scrolling is based on the JQuery library and a custom jquery script , include these files --> 
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="javascript/custom_jquery.js"></script> 
<style>
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');
</style> 
<script>
function mostrar_360(id){
 
  var visao='visao_'+id; 
  var foto_360='foto_360_'+id; 
  var video='video_'+id; 
  console.log(visao);
  document.getElementById(visao).style.display = "none";
  document.getElementById(foto_360).style.display = "block";
  document.getElementById(video).style.display = "none";
  
}
function mostrar_video(id){
  
  var visao='visao_'+id; 
  var foto_360='foto_360_'+id; 
  var video='video_'+id; 
  console.log(visao);
  document.getElementById(visao).style.display = "none";
  document.getElementById(foto_360).style.display = "none";
  document.getElementById(video).style.display = "block";

}

function mostrar_visao(id){

  var visao='visao_'+id; 
  var foto_360='foto_360_'+id; 
  var video='video_'+id; 
  console.log(visao);
  document.getElementById(visao).style.display = "block";
  document.getElementById(foto_360).style.display = "none";
  document.getElementById(video).style.display = "none";
 

}
var altura = window.screen.height;
var largura = window.screen.width;

console.log(largura);
</script>
<link rel="stylesheet" type="text/css"  href="styles.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    </head>
    <body>
    <div id="content">
    <div id="exibir">          
    <nav class="navbar">
    <div class="nav-wrapper">
      <div class="logo">  <img src="img/logo_50.png" class="brand-img" alt=""></div>
      <div class="busca">   <input type="text" class="search-box" placeholder="search"></div>
        <div class="nav-items">
        <img src="img/add.PNG" class="icon" alt="">
        </div>
    </div>
</nav>
</div>   

       
             
         
            
          
            <div class="article">
<div id="postedComments">

<!--  Include the following PHP include line to start the infinite scrolling functionality  -->
<?php require_once 'jquery-masterLoader.php' ;  ?>
</div>
 
            </div>     
            
            <div id="loadMoreComments" style="display:none;" ><div class="loader"></div>
</div>               
        </div>      
    </body>
<script>
// Script jQuery para esconder um elemento na página quando a rolagem ultrapassar 200px
$(window).scroll(function(){
        
        if($(document).scrollTop() > 200){// se a rolagem passar de 200px esconde o elemento
        
            $('#exibir').fadeOut(); // Esconde usando fadeOut
            
        } else { // senão ele volta a ser visivel
        
            $('#exibir').fadeIn(); // Mostra usando fadeIn
            
        }
        
    });


</script>   
</html>