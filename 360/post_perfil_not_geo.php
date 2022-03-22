<?php 
function formata_data_br_time($data) { 
	if ($data == "") return ""; 
		$corrige = explode("-",$data);
		$ano = explode(" ",$corrige[2]);
		$corrige = $ano[0]."/".$corrige[1]."/".	$corrige[0]." - ".$ano[1]; 
		return $corrige; 
	}
    function diasDatas($dtInicio) {
       

$dtFim = date('Y/m/d H:i:s');

$tsDiff = strtotime($dtFim) -strtotime($dtInicio);

$quantidadeDias =  $tsDiff /86400; // 86400 quantidade de segundos em um dia
if( $quantidadeDias < 1){
    $quantidadeDias= $quantidadeDias*24;
    $quantidadeDias=floor($quantidadeDias). " " ."Horas";
} else{
if( $quantidadeDias > 1 && $quantidadeDias < 2  ){
   
    $quantidadeDias="ontem";
} else{ 
/////////////////if dias/////////////
if( $quantidadeDias > 2 && $quantidadeDias < 7  ){
   
    $quantidadeDias=floor($quantidadeDias)." "."Dias";
} else {      $quantidadeDias="+ de 1 Semana "; }

////// mais de 1 semana ////////////
}




} 
return $quantidadeDias; // 31


    }    

    $altura=trim($_GET['largura']);
    if($altura > 600){
        $altura='600';
    }
    $lat=trim($_GET['lat']); 
    $lng=trim($_GET['lng']); 
    $url_perfil=trim($_GET['perfil']);
session_start();
error_reporting(0) ;
set_exception_handler('exception_handler') ;
$config = parse_ini_file("config/my.ini") ;
$db=new mysqli($config['dbLocation'] , $config['dbUser'] , $config['dbPassword'] , $config['dbName']);
if(mysqli_connect_error()) {
 throw new Exception("<b>Could not connect to database</b>") ;
}

if (!$result = $db->query("SELECT * FROM produtos WHERE nome_anunciante='$url_perfil' ORDER BY id DESC LIMIT 0,2")) {

    
    throw new Exception("<b>Could not read data from the table </b>") ;
}

while ($data = $result->fetch_object()) {
     $id = $data->id;
   $code=$data->code; 
   $endereco= mb_substr( $data->endereco, 0, 50, 'UTF-8' );
    $agora= diasDatas($data->data);
    ///$data_distancia= calculo($data->lat,$data->log,$lat,$lng);
    
    $preco="<div class='preco'>
        <img src='img/preco.png' class='icon' alt=''><span class='preco_texto'>$data->preco</span>
        </div >";
    if(isset($_SESSION['id'])){ 

       if($_SESSION['id']===$data->id_anunciante) {
      $ver="  <div class='preco'>  <button  class='share'><i class='material-icons'>edit</i><a href=https://www.anuncio360.com/360/atualizar_produto.php?id=$code> editar Anúncio </a></button></div>";
       }else{
       $ver="<div class='preco'>  <button  class='share'> <i class='material-icons'>whatsapp</i><a href=https://api.whatsapp.com/send?phone=+55$data->telefone&amp;text=Oi Vi seu anúncio e queria saber mais +https://www.anuncio360.com/$data->id'>
         $data->telefone </a></button></div>";
       }

     }else{
       $ver="<div class='preco'>  <button  class='share'> <i class='material-icons'>whatsapp</i><a href=https://api.whatsapp.com/send?phone=+55$data->telefone&amp;text=Oi Vi seu anúncio e queria saber mais +https://www.anuncio360.com/$data->id'>
         $data->telefone </a></button></div>";
     }

    

    $compartilhar="  <div class='preco'>  <button onClick='share()' class='share'><i class='material-icons'>share</i> <a href=#> Compartilhar</a></button></div>";

   
     

     $data->id_anunciante;
    if($data->urlcode){
        $url= '<iframe    width="100%" height='."$altura".' src='." $data->urlcode".' frameborder="0" allowfullscreen></iframe>';

    }else {

        $url= '<img src="img/FE5C64F8-DAEB-4146-9440-4688F874F63D.jpg" class="post-image" alt=""> '; 
    }
    echo "

    <div class='postedComment' id=\"$data->id \"></div>
    <div class='url_perfil' id=\"$data->id_anunciante \"></div>
    <section class='main'>
    <div class='wrapper'>    
        <div class='post'>
            <div class='info'>
               <div class='user'> 
                    <div class='profile-pic'><img src='$data->avatar' alt=''></div>
                    <p class='username'>$data->nome_anunciante</p>
                       
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
         </div> </div> 

    <div class='box-container' >
             <div id='visao_$id' style='display:none;'  >
                 <img src='img/4CB7B7BF-BAF2-4E7F-BF8E-9BF5587B4C38.jpg' class='post-image' alt=''>  
    </div> </div>
    <div class='post-content'>
    <div class='reaction-wrapper'>  $preco    $ver   $compartilhar  </div>
      
        <p class='likes'>$data->titulo</p>
        <p class='description'><span></span>$data->descricao</p>
        <p class='post-time'>$agora</p>
    </div>  
</div>
<p id='last'></p>
</div>
</section>
   " ;
    
    
        } 
/* close connection */
$db->close();
function exception_handler($exception) {
  echo "Exception cached : " , $exception->getMessage(), "";
}

?><script type="text/javascript">function share(){
    if (navigator.share !== undefined) {
        navigator.share({
           
            url: 'https://anuncio360.com/<?=$id;?>',
        })
        .then(() => console.log('Successful share'))
        .catch((error) => console.log('Error sharing', error));
    }
}</script>