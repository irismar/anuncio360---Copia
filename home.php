<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
<title>Anuncio 360</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description" content="Infinite Scrolling with Ajax PHP and JQuery" />
<meta name="keywords" content="jquery, Ajax, PHP, Infinite scrolling"/>
<meta name="viewport" content="width=device-width,initial-scale=1">

<meta http-equiv="Content-Language" content="pt-br">
<!--  Infinite scrolling is based on the JQuery library and a custom jquery script , include these files --> 
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="javascript/custom_jquery.js"></script>
 
<script>
 

</script>
<link rel="stylesheet" type="text/css"  href="styles.css" />
    </head>
    <body>
   
        <div id="content">
          <div id="exibir">    
          <nav class="navbar">
           <div class="nav-wrapper">
                <img src="img/logo_50.png" class="logo" alt="">
                <input type="text" class="search-box" placeholder="search">
             <div class="nav-items">            
                  <img src="img/add.PNG" class="icon" alt="">           
             </div>
          </div>
         </nav> 
       </div>
             <div class="article">
<div id="postedComments"><?php require_once 'jquery-masterLoader.php';?></div>
<div id="loadMoreComments" style="display:none;" > <div class="search-box">test for hidden field</center></div>   
            
            
        </div> </div>     
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