<? header("Access-Control-Allow-Origin: *"); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta property="og:locale" content="pt_BR">

<meta property="og:url" content="https://www.meusite.com.br/ola-mundo">
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="3deye.js"></script>
<?    require("connect.php");
if(isset($_GET['code']) &&( $_GET['code']!='') ){
   $code=trim($_GET['code']);
   $query_events ="  SELECT fotos,pasta  FROM  produto360 
   WHERE code='".$_GET['code']."'   ORDER BY id DESC LIMIT 1  ";      
   $resultado_events = $conn->prepare($query_events);
   $resultado_events->execute();
   $count= $resultado_events->rowCount();
 if($count=='0'){
     echo "ERRO AO ACESSAR O LINK ERRO COD 003  em caso de Dúvida envie email para suporte@auncio360.com ";
     exit();
 }
while($galeria = $resultado_events->fetch(PDO::FETCH_ASSOC)){        
   $pasta=$galeria['pasta']."/";   $númerode_fotos=$galeria['fotos'];   }  
  ?>
<div id="demo">
</div>
<script>
$(document).ready(function(){
$("#demo").vc3dEye({
imagePath:'<?php echo  $pasta; ?>', // the location where you’ve put the images.
totalImages: '<?php echo   $númerode_fotos;?>', // the number of images you have.
imageExtension:"jpg" // the extension of the images. Make sure all the images have same extension.
});});</script>
<? } ?>