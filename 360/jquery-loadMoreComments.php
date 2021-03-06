<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"><?php 
function formata_data_br_time($data) { 
    if ($data == "") return ""; 
        $corrige = explode("-",$data);
        $ano = explode(" ",$corrige[2]);
        $corrige = $ano[0]."/".$corrige[1]."/". $corrige[0]." - ".$ano[1]; 
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
session_start();    
error_reporting(0) ;
if($_GET['lastComment']){
set_exception_handler('exception_handler') ;
$config = parse_ini_file("config/my.ini") ;
$db=new mysqli($config['dbLocation'] , $config['dbUser'] , $config['dbPassword'] , $config['dbName']);
if(mysqli_connect_error()) {
 throw new Exception("<b>Could not connect to database</b>") ;
}
$altura=trim($_GET['largura']);
if($altura > 600){
    $altura=='600';
}

$lat=trim($_GET['lat']); 
$lng=trim($_GET['lng']);
$inicio = filter_input(INPUT_GET, "lastComment", FILTER_SANITIZE_URL);

$result = $db->query("SELECT *,
(6371 * acos(
cos( radians($lat) )
* cos( radians( lat ) )
* cos( radians( log ) - radians($lng) )
+ sin( radians($lat) )
* sin( radians( lat ) )
)
) AS distancia
FROM produtos
ORDER BY distancia ASC
 LIMIT $inicio, 2;
;



");






while ($data = $result->fetch_object()) {
    $id = $data->id;
    $code=$data->code;  
     
   $telefone=trim($data->telefone);
   $telefone= str_replace(' ', '', $telefone);
   $endereco= mb_substr( $data->endereco, 0, 50, 'UTF-8' );
    $agora= diasDatas($data->data);
    $inicio=$inicio+1;
    
    if($data->distancia < 1){
        $km= floor( $data->distancia*1000)."metros";
    } else{
    $km=floor($data->distancia)."Km";
    }

    $preco="<div class='preco'>
        <img src='img/preco.png' class='icon' alt=''><span class='preco_texto'>$data->preco</span>
        </div >";

    if(isset($_SESSION['id'])){ 
   
   
       if($_SESSION['id']==$data->id_anunciante) {
       $ver="  <div class='preco'>  <button  class='share'><i class='material-icons'>edit</i><a href=https://www.anuncio360.com/360/atualizar_produto.php?id=$code> editar An??ncio </a></button></div>";
       }else{
      $ver="<div class='preco'>  <button  class='share'> <i class='material-icons'>whatsapp</i><a href=https://api.whatsapp.com/send?phone=+55$telefone&amp;text=https://www.anuncio360.com/$data->id>
         $data->telefone </a></button></div>";
       }

     }else{
     
       $ver="<div class='preco'>  <button  class='share'> <i class='material-icons'>whatsapp</i><a href=https://api.whatsapp.com/send?phone=+55$telefone&amp;text=https://www.anuncio360.com/$data->id>
         $data->telefone </a></button></div>";
     }

    

    $compartilhar="  <div class='preco'>  <button onClick='share()' class='share'><i class='material-icons'>share</i> <a href=#> Compartilhar</a></button></div>";

    $mapa=" <div class='mapa'>
         <i class='material-icons'>route</i><p class='post-time'>distancia $km  </p>   
        <p class='mapa_texto'> <a href='https://www.google.com/maps/dir/$data->lat,$data->log/$lat,$lng/8&travelmode=walking'>GPS</p></a></div>";
     

     $data->id_anunciante;
    if($data->urlcode){
        $url= '<iframe    width="100%" height='."$altura".' src='." $data->urlcode".' frameborder="0" allowfullscreen></iframe>';

    }else {

        $url= '<img src="img/FE5C64F8-DAEB-4146-9440-4688F874F63D.jpg" class="post-image" alt=""> '; 
    }
    echo "
    <div class='postedComment' id=\" $inicio \"></div>
    <div class='lat' id=\"$lat \"></div>
    <div class='lng' id=\"$lng \"></div>
    <section class='main'>
     <div class='wrapper'>     
      <div class='post'>
            <div class='info'>
               <div class='user'> 
                    <div class='profile-pic'><img src='$data->avatar' alt=''></div>
                    <p class='username'>$data->nome_anunciante</p>
                       
               </div>  
               $mapa
       
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
   " ; ?><script type="text/javascript">function share(){
    if (navigator.share !== undefined) {
        navigator.share({
           
            url: 'https://anuncio360.com/<?=$id;?>',
        })
        .then(() => console.log('Successful share'))
        .catch((error) => console.log('Error sharing', error));
    }
}</script>

   <?
    
        }
/* close connection */
$db->close();
    } else {
    header("Location: index.php");
    die("Denny access");
    }

function exception_handler($exception) {
  echo "Exception cached : " , $exception->getMessage(), "";
} ?>

