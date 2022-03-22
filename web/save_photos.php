<?php

	if(!isset($_POST['base_img'])){

		die("{\"error\": \" Flopou. Cadê o base_img?\"}");
	}
	$result = [];
	$id_anuncio=trim($_GET['id_anuncio']);
	$id_anunciante=trim($_GET['id_usuario']);
    ///////////////criar pasta se for foto=1//////
      $pasta="imagens/".trim($_GET['id_usuario'])."/".trim($_GET['id_anuncio']);
    ///if(isset($_GET['foto'])&&($_GET['foto']==1)){
    
      $conexao = new PDO("mysql:host=mysql873.umbler.com; dbname=360", "360", "irisMAR100");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexao->exec("set names utf8");
    $sql2 ="  SELECT id,fotos FROM produto360  WHERE   id_anuncio=".$id_anuncio."   ORDER BY id DESC  limit 1";  
    $resultado_2 =  $conexao->prepare($sql2);
    $resultado_2->execute();
    $n=$resultado_2->rowCount();
     
    if($n !=0){        
while($row = $resultado_2->fetch()){  
    $n=$row['fotos'];
}

    } else{ 




      if(!is_dir($pasta)){ 
    mkdir(__DIR__.$pasta.'/', 0777, true);

     $pasta="imagens/".trim($_GET['id_usuario'])."/".trim($_GET['id_anuncio']);
if (!is_dir($pasta)) {
    mkdir($pasta, 0777, true);
} } }


	$data = str_replace(" ","+",$_POST['base_img']); //O envio do dado pelo XMLHttpRequest tende a trocar o + por espaço, por isso a necessidade de substituir. 
    ////$url = str_replace(" ","+",$_POST['base_url']); //O envio do dado pelo XMLHttpRequest tende a trocar o +
	////$name = md5(time().uniqid()); 
	$name =trim($_GET['foto']);///md5(time().uniqid()); 
	$path = $pasta."/".$name.".jpg";
	//data
	$data = explode(',', $data);
	//Save data
	file_put_contents($path, base64_decode(trim($data[1])));


	 if($n!=0){
        $stmt = $conexao->prepare('UPDATE produto360  SET fotos=fotos+1 WHERE id_anuncio= :id_anuncio');
        $stmt->execute(array( ':id_anuncio'=>$id_anuncio ));        
        }else { 
        $stmt = $conexao->prepare("INSERT INTO  produto360  (id_usuario,id_anuncio,pasta) VALUES (?,?,?)");
        $stmt->bindParam(1, $id_anunciante);
        $stmt->bindParam(2, $id_anuncio);
        $stmt->bindParam(3, $pasta);       
        $stmt->execute(); 
    }
	//Print Data
	$result['img'] = $path;
	$result['url'] =$_GET['foto'];
	echo json_encode($result, JSON_PRETTY_PRINT);

?>