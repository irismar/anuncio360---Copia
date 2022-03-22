 
<?php 

if( $file!=="home.php"){

///echo 'Verificar se tem correspondente';
}else{
////echo "deixa quieto";

}
if ( strpos(strtolower($_SERVER['SCRIPT_NAME']),strtolower(basename(__FILE__))) ) {
    header("Location: index.php");
    die("Denny access");
	}
error_reporting(0) ;
set_exception_handler('exception_handler') ;
$config = parse_ini_file("config/my.ini") ;
$db=new mysqli($config['dbLocation'] , $config['dbUser'] , $config['dbPassword'] , $config['dbName']);
if(mysqli_connect_error()) {
 throw new Exception("<b>Erro ao Conectar a Base</b>") ;
}
if (!$result = $db->query("SELECT * FROM produtos ORDER BY id DESC LIMIT 0,2")) {
    throw new Exception("<b>Erro ao comectar a tabela </b>") ;
}

while ($data = $result->fetch_object()) {
$id = $data->id;
$titulo = $data->titulo ;
$descricao = $data->descricao ;
$continent = $data->Continent;
$population = $data->Population ;
$url= '<iframe  width="100%" height="370" src='." $data->urlcode".' frameborder="0" allowfullscreen></iframe>';
echo " <div class='postedComment' id=\"$data->id \"></div>
<section class='main'>
<div class='wrapper'>
   
       

        <div class='post'>
            <div class='info'>
                <div class='user'>
                    <div class='profile-pic'><img src='img/cover 1.png' alt=''></div>
                    <p class='username'>modern_web_channel</p>
                </div>
                <div class='mapa'>
                      <img src='img/mapa.png' class='options' alt=''><p class='mapa_texto'>Mapa</p>
                </div>
            </div>

               <div class='box-container'>
            <div id='foto_360_$id'>
            <div  class='post-image'>  
            $data->urlcode
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
                      <a href'#' onClick=mostrar_360($id); >  <img src='img/360.png' class='visualizacao_icon' alt=''></a>
                  </div>  <div class='visualizacao'>     
                      <a href'#' onClick=mostrar_video($id); >  <img src='img/video.png' class='visualizacao_icon'   alt=''></a>
                  </div>  <div class='visualizacao'>    
                      <a href'#' onClick=mostrar_visao($id); >  <img src='img/google_stret.png' class='visualizacao_icon' alt=''></a>
                  </div> 
            </div>
            <div class='post-content'>
                <div class='reaction-wrapper'>
                <div class='preco'>
                <img src='img/preco.png' class='icon' alt=''><span class='preco_texto'>R$ 23,00</span>
                </div >
                <div class='preco1'>
                <img src='img/what.png' class='icon' alt=''><span class='preco_texto1'>Mandar Mensagem </span>
                </div >

                    
                </div>
                <p class='likes'>titulo do anuncio</p>
                <p class='description'><span>username </span> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur tenetur veritatis placeat, molestiae impedit aut provident eum quo natus molestias?</p>
                <p class='post-time'>2 minutes ago</p>
            </div>
           
        </div>
       
      
      
    
</div>
</section>

" ;

        } ?>    
   
<?
/* close connection */
$db->close();
function exception_handler($exception) {
 /// echo "Exception cached : " , $exception->getMessage(), "";
}

?>