 <div id="exibir">    
          <nav class="navbar">
           <div class="nav-wrapper">
            <div class="topo">  

               <? if(isset($_SESSION['id'])){ 
                if(isset($_SESSION['foto_perfil'])){
                  $foto_perfil_topo=$_SESSION['foto_perfil']; }else { $foto_perfil_topo='https://www.anuncio360.com/img/logo_50.png';
                }


                ?>
                 <div class="topo_logo"> <a href="https://www.anuncio360.com/<?=$_SESSION['nome'];?>">   <img src="<?=$foto_perfil_topo;?>"class="logo " alt=""> </a></div>
                 <div class="topo_nome">  <input type="text"  class="search-box"  placeholder="Buscar"></div>
                 <div class="topo_itens"> <div class="nav-items "><a href="https://www.anuncio360.com/adicionar" >  <i class="material-icons">add_circle_outline</i></a></div></div>
                 <div class="topo_itens"> <div class="nav-items "><a href="https://www.anuncio360.com/configurar" > <i class="material-icons">settings</i></a></div>



               <? } else {     ?>

                 <div class="topo_logo"> <a href="https://www.anuncio360.com/">    <img src="https://www.anuncio360.com/img/logo_50.png" class="logo " alt=""></a></div>
                 <div class="topo_nome">  <input type="text"  class="search-box"  placeholder="Buscar"></div>
                 <div class="topo_itens"> <div class="nav-items "><a href="https://www.anuncio360.com/entrar" >  <i class="material-icons">add_circle_outline</i></a></a></div></div>
                 <? }?>
                </div>
          </div>
         </nav> 
         <div class="caixa_exibir"  style="display:none;"  id="result"></div>
       </div>