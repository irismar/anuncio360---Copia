<? $post= 

 "<div class='postedComment' id=\"$inicio \"></div>
<div class='lat' id=\"$lat \"></div>
<div class='lng' id=\"$lng \"></div>
<section class='main'>
<div class='wrapper'>
<div class='post'>
<div class='info'>
    <div class='user'>

    <a href='https://www.anuncio360.com/$data->nome_anunciante'><div class='profile-pic'><img src='$avatar' alt=''></div></a>
    <p class='username'><a href='https://www.anuncio360.com/$data->nome_anunciante'>$data->nome_anunciante</a></p>
         
    </div>

    <div class='mapa'>
    <img src='img/distancia.jpg' class='options' alt=''><p class='post-time'>distancia $km</p>
    <img src='img/mapa.png' class='options' alt=''><p class='mapa_texto'> <a href='https://www.google.com/maps/dir/$data->lat,$data->log/$lat,$lng/'>  Mapa</p></a>
    </div>
    
</div>



<div class='info2'>


   
<div class='mapa2'>
<p class='mapa_texto2    '> $endereco</p>
</div>
   

   



</div>




   <div class='box-container'>
<div id='foto_360_$id'>
<div  class='post-image'>  
$url  
</div></div>  
   </div>

<div class='box-container' >
     <div id='video_$id'  style='display:none;' >            
        <img src='img/FE5C64F8-DAEB-4146-9440-4688F874F63D.jpg' class='post-image' alt=''>  
     </div>
</div> 

<div class='box-container' >
         <div id='visao_$id' style='display:none;'  >
             <img src='img/4CB7B7BF-BAF2-4E7F-BF8E-9BF5587B4C38.jpg' class='post-image' alt=''>  
</div> 

</div>


<div class='reaction-wrapper'>
      <div class='visualizacao'>     
          <a href'#' onClick=mostrar_360($id) >  <img src='img/360.png' class='visualizacao_icon' alt=''></a>
      </div>  <div class='visualizacao'>     
          <a href'#' onClick=mostrar_video($id) >  <img src='img/video.png' class='visualizacao_icon'   alt=''></a>
      </div>  <div class='visualizacao'>    
          <a href'#' onClick=mostrar_visao($id) >  <img src='img/google_stret.png' class='visualizacao_icon' alt=''></a>
      </div> 
</div>
<div class='post-content'>
    <div class='reaction-wrapper'>
    <div class='preco'>
    <img src='img/preco.png' class='icon' alt=''><span class='preco_texto'>$data->preco</span>
    </div >

    
  <div class='preco'>  <button  class='share'><img src='../img/what.png'><a href=https://api.whatsapp.com/send?phone=+55$data->telefone&amp;text=Oi Vi seu anúncio e queria saber mais +https://www.anuncio360.com/$data->id'>
         $data->telefone </a></button></div>

       

      <div class='preco'>  <button onClick='share()' class='share'><img src='../img/compartilhar.png'> <a href=#> Compartilhar</a></button></div>

        
    </div>
    <p class='likes'>$data->titulo</p>
    <p class='description'><span> </span>$data->descricao</p>
    <p class='post-time'>$agora</p>
</div>

</div>


<p id='last'></p>

</div>
</section>
" ;?>