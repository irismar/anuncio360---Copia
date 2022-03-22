<?php
   
   if($_FILES){
       
        $response=array();
        $codigo=trim($_FILES['codigo']['name']);
  //echo   $codigo2="fqgnn5jskbdS";
    
    $img_path='./foto_perfil/' . $_FILES['photo']['name'];
   $img_pathComplete='https://anuncio360.com/projeto/foto_perfil/'.$codigo.'.jpg';
    //move_uploaded_file($_FILES['photo']['tmp_name'], './photos/' . $_FILES['photo']['name'])


        $servername ="mysql873.umbler.com";
        $username = "360";
        $password ="irisMAR100";
        $dbname ="360";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT id FROM usuario WHERE  token= '$codigo'  ";
        $result = $conn->query($sql);        
      
        if($result){
            if ( $result->num_rows >0) {
        
         
       
            $sql = "UPDATE usuario  SET Foto_perfil='$img_pathComplete'  WHERE  token='$codigo' ";

            if ($conn->query($sql) === TRUE) {

              if(move_uploaded_file($_FILES['photo']['tmp_name'],$img_path )){
                require("lib/WideImage.php");
                $image = WideImage::load( $img_path);
                $resized = $image->resize('600','600', 'inside'); 
               
                    
                $resized->saveToFile('foto_perfil/'.$codigo.'.jpg');  
                unlink($img_path );

                $response = "Foto salva Com Sucesso";


           
              } else {    $response = "Erro ao redimensionar";}

              
            } else {
              
            
    }

}  } else{  $response = "Usuario não encontrado";}

} else {$response = "Dados não Enviado";

  

    
}      
       
     




  

    
    
    


http_response_code(200);
echo json_encode($response);
 