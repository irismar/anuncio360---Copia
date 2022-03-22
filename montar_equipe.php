<? include_once'topo.php'; 


$customers = null;
$customer = null;
$ver_esquipe =null;
global $ver_esquipe;
global $customers;
$customers = find('setor',$_GET['setor'],'  WHERE id=',"ORDER BY id DESC" );
if ($customers) : 
foreach ($customers as $customer) : 
endforeach; else : endif; 

  $stmt=$conexao->prepare("SELECT id,id_membro   FROM equipe WHERE id_setor=".$_GET['setor']."    ORDER BY id DESC limit 99   ");
  $stmt->execute(); 
  ////se executou exibir
  $count = $stmt->rowCount();
  $contar=trim($count);
  if( $customer['tipo_escala']=='12X36DN'  or  $customer['tipo_escala']=='12X36D' or  $customer['tipo_escala']=='12X36N' ){ 
     

   $ordem=$contar+1;

     }
 ///     fim exibir menu
///agora preiso recuperar o ultimo id 
if( $customer['tipo_escala']=='12X24X12X96'){
  $customer['numero_tecnicos_turno'];
if($customer['numero_tecnicos_turno']=="1"){
   $ordem=$contar+1;
  }
if($customer['numero_tecnicos_turno']!="1"){
if($contar=='0' ||  $contar=='1'  ){
  $ordem="1";
}
 if($contar=='2' || $contar=='3'){
  $ordem="2";
}
 if($contar=='4' ||  $contar=='5'){
  $ordem="3";
}
 if($contar=='6' ||  $contar=='7'){
  $ordem="4";
}
 if($contar=='8' ||  $contar=='9'){
  $ordem="5";
}
 if($contar=='10' ||  $contar=='11'){
  $ordem="6";
}
 //////////////////////////////////////////////////
if($contar=='1' || $contar=='0')  {
$V_ordem="1";
 }
 if($contar=='2' ||  $contar=='3'){
 $V_ordem="2";
 }
 if($contar=='4' ||  $contar=='5'){
 $V_ordem="3";
 }
 if($contar=='6' ||  $contar=='7'){
 $V_ordem="4";
 }
 if($contar=='8' ||  $contar=='9'){
 $V_ordem="5";
 }
 if($contar=='10' ||  $contar=='11'){
 $V_ordem="6";
 }
}
 //////if $customer['numero_tecnicos_turno']=1
} ////////////seescala for 12X24X12X96

if(isset($_POST['nome_tecnico'])){
trim($_POST['nome_tecnico']);
$post=explode("/",$_POST['nome_tecnico']);
echo $add['nome']=$post['1'];echo "<br>";
$add['setor']=$customer['setor'];
echo $add['id_setor']=$customer['id'];echo "<br>";
echo $add['id_membro']=$post['0'];echo "<br>";
$add['tipo_escala']=$_POST['tipo_escala'];

$add['data']=$agora;
$add['padrao_escala']=$customer['tipo_escala'];
$add['id_cordenador']=$_SESSION['id'];
if(isset($_GET['nova_ordem'])){ 
  $add['ordem_equipe']=trim($_GET['nova_ordem']);
 
  $stmt = $conexao->prepare('UPDATE equipe  SET tipo_escala= :tipo_escala, nome=:nome,id_membro=:id_membro WHERE id= :id AND  id_setor= :id_setor');
   $stmt->execute(array(
    ':id'   =>$_GET['id_equipe'],
    ':id_membro'   =>$post['0'],
    ':id_setor'   =>$customer['id'],
    ':nome'   =>$post['1'],
    ':tipo_escala'=>"normal"
  )); 

   ////atualizar eventos//////////
   echo $id_antigo= trim($_GET['id_usuar_antigo']); echo "id usuario antigo"."<br>";
   echo $id_atualizar= trim($post['0']); echo "novo usuario"."<br>";
   echo trim($customer['id']);echo"id setor"."<br>";
   $stmt = $conexao->prepare('UPDATE events  SET  nome_usuario=:nome , id_usuario=:id_novo  WHERE id_usuario=:id_usuario AND  id_setror=:id_setror');
   $stmt->execute(array(
     ':id_usuario'   =>trim($id_antigo),
     ':id_novo'   =>trim($id_atualizar),
     ':id_setror'   =>trim($customer['id']),
     ':nome'   =>$post['1']
    
   )); 
  $urlretorno="http://localhost/montar_equipe.php?setor=".$_GET['setor'];
  header('Location:'.$urlretorno);
  exit();
} else { 
  $add['ordem_equipe']=$ordem;
  save('equipe', $add);
 
}

} 
////////////////////////////////se input//////
if(isset($_POST['nome_tecnico_cad'])){ 

  $nome=trim($_POST['nome_tecnico_cad']);
  $sobre_nome=trim($_POST['sobre_nome_tecnico_cad']);
  $data=date('y-m-d h:i:s');
  $session=uniqueAlfa(11);
  $codigo_acesso= uniqueAlfa(4);
  $add['nome']=trim($_POST['nome_tecnico_cad']);
  $add['sobrenome']=trim($_POST['sobre_nome_tecnico_cad']);
  $add['coren']=trim($_POST['coren']);
  $add['data_cadastro']=$agora;
  $add['session']=uniqueAlfa(11);
  $add['codigo_acesso']=uniqueAlfa(4);
  $add['local_trabalho']=$_SESSION['local_trabalho'];
  ///consultar se não existe usuario cadastrado////
  $stmtz = $conexao->prepare("SELECT *  FROM usuario  WHERE coren=:id   ORDER BY id ASC LIMIT 10 ");
  $stmtz->bindValue(":id", trim($_POST['coren']));
  $stmtz->execute();

    $count = $stmtz->rowCount();
      if($count >0){ ?><a href="http://localhost/montar_equipe.php?setor=<?=$_GET['setor']?>">
      <div style="margin-top: 20%; " class=" alert alert-dark" role="alert"><p>
  <h4 class="alert-heading">Erro!</h4>
 Já existe usuario cadastrado com número Coren 
   <h2><?=trim($_POST['coren'])?></h2></p>
  <hr>
  <p class="h3">Voltar para cadastro</p>
</div>
        <div style="margin-top: 20%; color: #fff;" class="alert alert-light" role="alert">
        <span class="badge badge-pill badge-primary "style=" color: #fff;"  >Operação Relazada Com Sucesso </span></a>
        </div> <? exit(); } 
  ///fom consulta 
 
  save('usuario', $add); 
        
  if(isset($_GET['nova_ordem'])){ echo "exluir usurio";
    $stmt = $conexao->prepare('DELETE FROM  equipe   WHERE  id=:id');
    $stmt->bindParam(':id',$_GET['id_equipe']);      
    $stmt->execute();

  
  }
  ///excluir usuario  
$stmt=$conexao->prepare("SELECT id FROM usuario    ORDER BY id DESC limit 1 ");
$stmt->execute(); 
if ($stmt->execute()) {
/////se executou exibir
 $count = $stmt->rowCount();
///contar quntos resgistro
while ($login = $stmt->fetch(PDO::FETCH_OBJ)) {
 $ultimo_id=$login->id;
} }
  $padrao_escala=$customer['tipo_escala'];
  if(isset($_GET['nova_ordem'])){ $ordem=$_GET['nova_ordem'];}
  $nome_membro=$_POST['nome_tecnico_cad']. " ".$_POST['sobre_nome_tecnico_cad'];
  $stmt = $conexao->prepare("INSERT INTO equipe (nome,setor,id_setor,id_membro,tipo_escala,ordem_equipe,data,padrao_escala,id_cordenador) VALUES (?,?,?,?,?,?,?,?,?)");
  $stmt->bindParam(1,$nome_membro);
  $stmt->bindParam(2,$customer['setor']);
  $stmt->bindParam(3,$_GET['setor']);
  $stmt->bindParam(4,$ultimo_id);
  $stmt->bindParam(5,$_POST['tipo_escala']); 
  $stmt->bindParam(6,$ordem);
  $stmt->bindParam(7,$agora);
  $stmt->bindParam(8,$customer['tipo_escala']);
  $stmt->bindParam(9,$_SESSION['id']);
  
  $cad_user_ok=$stmt->execute();  
  $Segir="ok";  
  if($cad_user_ok){ 
    $urlretorno="http://localhost/montar_equipe.php?setor=".$_GET['setor'];
    header('Location:'.$urlretorno);
    exit();
  $_SESSION['envio']="1";
  }  else {echo "erro ao gravar"; }      
////////////fim gravar////////////////////////////
}
//////////////////////////////////////////////////
////////////////exibir menu/////////////////////
if(isset($_GET['setor'])){
  $_SESSION['id_para_setor']=$_GET['setor'];
  }

?>

<script>
$(document).ready(function(){           
    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function(){
        $(this).parent(".card").find(".toggle").addClass("rotate");
    }).on('hide.bs.collapse', function(){
        $(this).parent(".card").find(".toggle").removeClass("rotate");
    });
});
</script>

 
<?include_once"menu.php";?>            
    <div class="card">        
               
       

<?  
$customers = null;
$customer = null;
$ver_esquipe =null;
global $ver_esquipe;
$contar_equipe =null;
global$contar_equipe;
global $customers;
$customers = find('setor',$_GET['setor'],'  WHERE id=',"ORDER BY id DESC" );
?><div class="table-responsive">
<table class="table">
<thead>
	<tr>
		
		<th class="text-center" ><i class="fa fa-hospital-o" aria-hidden="true"></i></th>
		<th class="text-center" ><i class="fa fa-users" aria-hidden="true"></i></th>
		<th class="text-center" ><i class="fa fa-table" aria-hidden="true"></i></th>
		<th class="text-center" > Equipes</th>
    <th class="text-center" >Total </th>
    <th class="text-center" >Cadastros </th>
	</tr>
</thead>
<tbody>
<?php   if ($customers) : ?>
<?php foreach ($customers as $customer) : 
 ///var_dump($customer);?>
	<tr>
	
		<td class="text-center"><?php echo $customer['local']; ?></td>
		<td class="text-center" ><?php echo $customer['setor']; ?></td>
    <td class="text-center" ><?php echo $customer['tipo_escala']; ?></td>
		<td class="text-center" ><?php echo $customer['numero_tecnicos_turno']; ?></td>
    <td class="text-center" ><?php echo $customer['numero_de_equipes']; ?></td>
    <td class="text-center" ><?php echo $customer['numero_tec_total']; ?></td>
    <?php endforeach; 
    $ver_esquipe = find('equipe',$customer['id'],' WHERE  id_setor=' );
   // var_dump($ver_esquipe);
   @$contar = count($ver_esquipe);
    ?>
    <td><?php  if(@count($ver_esquipe)){ echo count($ver_esquipe);  $contar = count($ver_esquipe);}
    else{  $contar =="0"; } ?></td>
		</tr>
   <?php else : ?>
	<tr>
		<td colspan="6">Nenhum registro encontrado.</td>
	</tr>
<?php endif; ?>
</tbody>
</table>
</div>
        
<?
///     fim exibir menu
///agora preiso recuperar o ultimo id 
///////////////////////////////////////////////

 $contar. "=".$customer['numero_tec_total'];
     if( ($contar != $customer['numero_tec_total'] ) or  (isset($_GET['nova_ordem'])) ){
       if(isset($_GET['nova_ordem'])){
       ?>
     
  <form role="form" method="post" action="?setor=<?=trim($_GET['setor']);?>&&nova_ordem=<?=trim($_GET['nova_ordem']);?>&&id_equipe=<?=trim($_GET['id_equipe']);?>&&id_usuar_antigo=<?=trim($_GET['id_usuar_antigo'])?>" > 
  <?} else { ?> 
    <form role="form" method="post" action="?setor=<?=trim($_GET['setor']);?>" > 
  
   <?} ?> <div class="form-row col-md-12">
  <div class="col-md-12 mb-3">
     
              <input type="text"   name="nome_tecnico"  class="form-control" autocomplete="off" placeholder="Nome do Membro"  value="" id="inputString" onKeyUp="lookup(this.value);" onBlur="fill();" />
              <div class="suggestionsBox " id="suggestions" style="display: none;">
              <div class="suggestionList" id="autoSuggestionsList"></div>
              </div>
   </div>
    
  <div class="col-md-12 mb-3"> 
   <input type="hidden" name="tipo_escala" value="normal" />
  <input type="hidden" name="session" value="<?=session_id();?>" />
  <button class="btn btn-primary form-control" type="submit">Salvar</button></div>
  </div>
</div>

</form>
<? if( isset($_GET['nova_ordem'])  ){ ?>
<p class="  col-md-12 text-center">Para Membro para escala Ordem <?=$_GET['nova_ordem']?></p><?} ?>
<p class="  col-md-12 text-center">Para cadastrar membro  adiciona-lo a essa equipe preencha campo abaixo </p>
 <small id="passwordHelpBlock" class="form-text text-muted text-center">O Cadastro Será realizado apenas uma Vez para <a href="#"> saber mais </a>  </small><br>

<? if(isset($_GET['nova_ordem'])){ ?>
  <form role="form" method="post" action="?setor=<?=trim($_GET['setor']);?>&&nova_ordem=<?=trim($_GET['nova_ordem']);?>&&id_equipe=<?=trim($_GET['id_equipe']);?>&&id_usuar_antigo=<?=trim($_GET['id_usuar_antigo'])?>" > 
<? } else { ?>
  <form role="form" method="post" action="?setor=<?=trim($_GET['setor']);?>" >    
  <? } ?>   <div class="form-row col-md-12 row">
   
   <div class="col-md-4 mb-3">
   <input type="text"   name="nome_tecnico_cad"  class="form-control" placeholder="Nome "   />
   </div>
   <div class="col-md-8 mb-3">
 
   <input type="text"   name="sobre_nome_tecnico_cad"  class="form-control" placeholder="Sobre Nome"   />
   </div>

   <div class="col-md-6">
 
   <input type="text"   name="coren"  class="form-control" placeholder="COREN "   />
   </div>
   <br>
   <div class="col-md-6"> 
        <input type="hidden" name="tipo_escala" value="normal" />
       <input type="hidden" name="session" value="<?=session_id();?>" />
       <button class="btn btn-primary form-control" type="submit">Salvar</button>

<br>
<br>
     </div>
  </div>
</div>
  
</form> <br><p><?= $customer['escala_erro '];?> 
<div class="card col-12 col-sm-12 col-md-8 col-lg-12 ">
<?if(!isset($_GET['nova_ordem'])){ ?>
  <a href="/incompleto.php?setor=<?=$_GET['setor'];?>" class="btn btn-primary form-control">Gerar Escala  Imcompleta </a>
 <?} ?>
</div>
 <?   } else{  
   //////////////////se escala completa///////
   ?> <? if( $customer['escala_erro']!='0'):?> 
 <div class="card text-center">
 
  <h5 class="card-title text-center">Cadastro  Concluido </h5>
  
  <a href="/revisao.php?id=<?=$_GET['setor'];?>" class="btn btn-primary">Gerar Escala</a>
 
  
 
</div>
 <? endif; }
  ?>
<?
//$stmt = $conexao->prepare("SELECT *  FROM equipe  WHERE id_setor=:id    ORDER BY id DESC");
///////$stmt->bindValue(":id", $_SESSION['id_para_setor']  );
///$stmt->execute();
$equipe= null;
global $equipe;
///seleciona os dados da equipe para visualização ///////
$equipe= find('equipe ',$customer['id'],'  WHERE id_setor=',"ORDER BY ordem_equipe ASC" );

   if($contar < $customer['numero_tec_total']){ } else{  ?>
     
  
   
<?} ?>
<div class="card col-12 col-sm-12 col-md-12 col-lg-12  ">
 <table class="table">
    <thead>
    <tr>
 
 <th class="text-center"><i class="fa fa-user" aria-hidden="true"></i></th>

 <th class="text-center"><i class="fa fa-building-o" aria-hidden="true"></i></th>

 <th class="text-center"><i class="fa fa-users" aria-hidden="true"></i></th>

 <th class="text-center"><i class="fa fa-table" aria-hidden="true"></i></th>

 <th class="text-center"><i class="fa fa-braille" aria-hidden="true"></i></th>
 <th class="text-center"><i class="fa fa-cogs" aria-hidden="true"></i></th>
 <th class="text-center"><i class="fa fa-cogs" aria-hidden="true"></i></th>
     
    </tr>
  </thead><?
  if ($equipe) : 
 foreach ($equipe as$equipes) : ?>
  <tr>
  <td class="text-center"><?php echo $equipes['nome']; ?></td>
  <td class="text-center"><?php echo $equipes['setor']; ?></td>
  <td class="text-center"><?php echo $equipes['ordem_equipe']; ?></td>
  <td class="text-center"><?php echo $equipes['tipo_escala']; ?></td>
  <td class="text-center"><?php echo $equipes['padrao_escala']; ?></td>
  <td class="text-center">
  <select onchange="location.href=this.value" class="custom-select">
 <option value="#">Ação </option>

 <?php if($equipes['tipo_escala']=="aberta"){; ?> 
  <option value="http://localhost/montar_equipe.php?setor=<?php echo trim($_GET['setor']); ?>&&nova_ordem=<?php echo $equipes['ordem_equipe']; ?>&&id_equipe=<?php echo $equipes['id']; ?>&&id_usuar_antigo=<?php echo $equipes['id_membro']; ?>">Ocupar escala Aberta </option> <?}else {?>
    <option value="http://localhost/acao.php?exluir_membro_equipe=<?php echo $equipes['id_membro']; ?>&&id_setor=<?php echo trim($_GET['setor']); ?>">Escluir Membro  Equipe</option>   <?} ?>  	 
     <option value="http://localhost/ferias.php?ferias_30_dias_id=<?php echo $equipes['id_membro']; ?>&&id_setor=<?php echo trim($_GET['setor']); ?>">Ferias 30 dias </option>
    <option value="http://localhost/acao.php?exluir_membro_equipe=<?php echo $equipes['id_membro']; ?>&&id_setor=<?php echo trim($_GET['setor']); ?>">Ferias 15 dias </option>
    <option value="http://localhost/atestado.php?atestado_dias_id=<?php echo $equipes['id_membro']; ?>&&id_setor=<?php echo trim($_GET['setor']); ?>">Atestado  </option>
	  </select>    

</td>
</tr>
 <? endforeach; else : ?> 	<td colspan="6">Nenhum registro encontrado.</td><? endif; ?>
  
 
  </tbody>
  </table>
<div></div></div></div>

<script>
/////////////////////////////////////script para impedir reemvio pelo botão atualizar//
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>


 

</form>

<script type="text/javascript">
 function lookup(inputString) {
   if(inputString.length == 0) {
     // Hide the suggestion box.
     $('#suggestions').hide();
   } else {
     $.post("listar_membros.php", {queryString: ""+inputString+""}, function(data){
       if(data.length >1) {
         $('#suggestions').show();
         $('#autoSuggestionsList').html(data);
       }
     });
   }
 } 
 
 function fill(thisValue) {
   $('#inputString').val(thisValue);
   setTimeout("$('#suggestions').hide();", 200);
 }

 $(".button").click(function () {
    $("#sForm").toggleClass("open");   
  });

  $(".controlTd").click(function () {
    $(this).children(".settingsIcons").toggleClass("display"); 
    $(this).children(".settingsIcon").toggleClass("openIcon"); 
  });


</script>
