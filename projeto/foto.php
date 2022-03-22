<?php
   session_start();
    if($_FILES){
        require("connect.php");
    

function random_str(
  int $length = 64,
  string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
  if ($length < 1) {
      throw new \RangeException("Length must be a positive integer");
  }
  $pieces = [];
  $max = mb_strlen($keyspace, '8bit') - 1;
  for ($i = 0; $i < $length; ++$i) {
      $pieces []= $keyspace[random_int(0, $max)];
  }
  return implode('', $pieces);
}
$token = random_str(12);
        $result=connect();
        $response=array();
    $id_anuncio=$_FILES['id_anuncio']['name'];
    $id_anunciante=$_FILES['id_anunciante']['name'];
    $pasta="imagens/".$id_anunciante."/". $id_anuncio;
    ////////////////////////concectar com banco ////////////////
 
    $sql2 ="  SELECT id,fotos FROM produto360  WHERE   id_anuncio=".$id_anuncio."   ORDER BY id DESC  ";  
    $resultado_2 =  $conexao->prepare($sql2);
    $resultado_2->execute();
    $n=$resultado_2->rowCount();
     
    if($n !=0){        
while($row = $resultado_2->fetch()){  
    $n=$row['fotos'];
}

    } else {  
    if(!is_dir($pasta)){ 
    mkdir(__DIR__.$pasta.'/', 0777, true);

    $path = "imagens/".$id_anunciante."/". $id_anuncio;;
if (!is_dir($path)) {
    mkdir($path, 0777, true);
} } } 



    $img_path=$pasta ."/". $_FILES['photo']['name'];
    //move_uploaded_file($_FILES['photo']['tmp_name'], './photos/' . $_FILES['photo']['name'])
  
    if(move_uploaded_file($_FILES['photo']['tmp_name'],$img_path )){
        require("lib/WideImage.php");
        $image = WideImage::load( $img_path);
        
       
      
        $n_foto=$n+1;
          
        $image->saveToFile($pasta.'/'.$n_foto.'.jpg');  
        unlink($img_path );
        $code=random_str(12);
        if($n!=0){
        $stmt = $conexao->prepare('UPDATE produto360  SET fotos=fotos+1 WHERE id_anuncio= :id_anuncio');
        $stmt->execute(array( ':id_anuncio'=>$id_anuncio ));        
        }else { 
        $stmt = $conexao->prepare("INSERT INTO  produto360(id_usuario,id_anuncio,pasta,code) VALUES (?,?,?,?)");
        $stmt->bindParam(1, $id_anunciante);
        $stmt->bindParam(2, $id_anuncio);
        $stmt->bindParam(3, $pasta);
        $stmt->bindParam(4, $code );
        $stmt->execute(); 
        $codeurl='https://anuncio360.com/projeto/galeria360.php?code='.$code;
        $stmt = $conexao->prepare('UPDATE produtos  SET urlcode="'.$codeurl.'" WHERE id= :id');
        $stmt->execute(array( ':id'=>$id_anuncio ));  
       
        } 
        


        ////$sql="INSERT INTO imagenes(img,id_anuncio,id_anunciante) VALUES (:img,:id_anuncio,:id_anunciante)";
        /////$img='https://anuncio360.com/projeto/photos/'.$_FILES['photo']['name'];
        
     
        
    } else{

        $response = [
            "erro" => true,
            "messagem" => "Nãa foi Possivel Exportar a Imagem!"
        ];


    }
  

    if($res){
        $response = [
            "erro" => false,
            "messagem" => "imagem salva Com Sucesso"
        

        ];
    }else{
        $response = [
            "erro" => true,
            "messagem" => "Erro ao Acicionar a imagem!"
        ];
    }
    
    
}else{
    $response = [
        "erro" => true,
        "messagem" => "Nãa foi Possivel Exportar a Imagem!"
    ];
}

http_response_code(200);
echo json_encode($response);