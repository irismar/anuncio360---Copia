

<?php
#Verifica se tem um email para pesquisa
if(isset($_POST['usuario']) && $_POST['usuario']!=''){ 
    #Recebe o Email Postado
    $usuario = $_POST['usuario'];
    #Conecta banco de dados 
    $con = mysqli_connect("mysql873.umbler.com","360","irisMAR100","360");
    $sql = mysqli_query($con, "SELECT usuario FROM usuario WHERE usuario = '{$usuario}'") or print mysql_error();
    #Se o retorno for maior do que zero, diz que já existe um.
    if(mysqli_num_rows($sql)>0) 
        echo json_encode(array('usuario' => ' existe um usuario cadastrado com este nome')); 
    else 
        echo json_encode(array('usuario' => 'OK' )); 
} ?>