_debug = true;

function dbg(msg) {
    if (_debug)
        console.log (msg);
}
var erro=false;
var carga=false;
var largura = window.innerWidth;
if(largura > 600){
    largura=600;
}
  var windowHeight = window.innerHeight;

$(document).ready(function() {
   $("#id_anuncio").append( "<p id='last'></p>" );
if ('geolocation' in navigator) {


  navigator.geolocation.getCurrentPosition(
    function (position) {

        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        $.ajax({
            dataType : "html",
            url: "/360/carregar_produto.php?lat="+lat+"&&lng="+lng+"&&id="+$(".id_anuncio:last").attr('id')+"&&largura="+largura,
           success: function(html){
                log('acesso sucesso produto idl index' +$(".id_anuncio:last").attr('id')+'Com geolocation ATIVADO lat='+lat+'&&lng='+lng);
                 
               $("#postedComments").html(html);
             }});   

    
             
    },
    function (error) {
     
      
     erro=true;
      $.ajax({
          dataType : "html",
          url: "/360/carregar_produto_not_geo.php?lat=null&&lng=null&&id="+$(".id_anuncio:last").attr('id')+"&&largura="+largura,
         success: function(html){
              log('acesso sucesso produto idl index' +$(".id_anuncio:last").attr('id'));
                 
           
        
             $("#postedComments").html(html);
           }});   


    }
  )
} else {
  Alert('ops')
}





  


    
    doMouseWheel = 1 ;
    $("#postedComments").append( "<p id='last'></p>" );
    dbg("Document Ready");
    
    $(window).scroll(function() {
        dbg("Window Scroll Start");

        if (!doMouseWheel)
            return;

         var distanceTop =$('#last').offset().top - $(window).height()+2300000;
     
        if  ($(window).scrollTop() > distanceTop) {
            dbg("Window distanceTop to scrollTop Start");
            $('div#loadMoreComments').show();
            doMouseWheel = 0 ;
            
            dbg("Another window to the end !!!! "+$(".postedComment:last").attr('id'));

              console.log(erro)
              if(erro){
                ////////////////////////se nao permitir gps////////////////////
           console.log('eu erro  exibir todos')
           $.ajax({
            dataType : "html",

            url: "360/not_localizacao_2.php?lastComment="+ $(".postedComment:last").attr('id'),
            success: function(html) {
                 carga=true;
             




                doMouseWheel = 1	 ;
                if(html){
                    $("#postedComments").append(html);
                    dbg('Append html: ' + $(".postedComment:first").attr('id'));
                    dbg('Append html: ' + $(".postedComment:last").attr('id'));

                    $("#last").remove();
                    $("#postedComments").append( "<p id='last'></p>" );
                    $('div#loadMoreComments').hide();
                } else {
                    //Disable Ajax when result from PHP-script is empty (no more DB-results )
                    $('div#loadMoreComments').replaceWith( "<div class='topo'>Fim</div>" );
                    doMouseWheel = 0 ;
                }

        

             
            }
        });

          


                /////////////////////se nao permitir gps fim /////////////////
              
              } else { 


              
            $.ajax({
                dataType : "html",

                url: "360/jquery-loadMoreComments.php?lastComment="+ $(".postedComment:last").attr('id')+"&&lat="+$(".lat:last").attr('id')+"&&lng="+$(".lng:last").attr('id'),
                success: function(html) {

                /////////https://anuncio360.com/projeto/galeria360.php?code=61dc8f0913407/////




                    doMouseWheel = 1	 ;
                    if(html){
                        $("#postedComments").append(html);
                        dbg('Append html: ' + $(".postedComment:first").attr('id'));
                        dbg('Append html: ' + $(".postedComment:last").attr('id'));

                        $("#last").remove();
                        $("#postedComments").append( "<p id='last'></p>" );
                        $('div#loadMoreComments').hide();
                    } else {
                        //Disable Ajax when result from PHP-script is empty (no more DB-results )
                        $('div#loadMoreComments').replaceWith( "<div class='topo'>Fim</div>" );
                        doMouseWheel = 0 ;
                    }
                }
            });

          }
        }
    });
});



function mostrar_360(id){
 
  var visao='visao_'+id; 
  var foto_360='foto_360_'+id; 
  var video='video_'+id; 
  console.log(visao);
  document.getElementById(visao).style.display = "none";
  document.getElementById(foto_360).style.display = "block";
  document.getElementById(video).style.display = "none";
  
}
function mostrar_video(id){
  
  var visao='visao_'+id; 
  var foto_360='foto_360_'+id; 
  var video='video_'+id; 
  console.log(visao);
  document.getElementById(visao).style.display = "none";
  document.getElementById(foto_360).style.display = "none";
  document.getElementById(video).style.display = "block";

}

function mostrar_visao(id){

  var visao='visao_'+id; 
  var foto_360='foto_360_'+id; 
  var video='video_'+id; 
  console.log(visao);
  document.getElementById(visao).style.display = "block";
  document.getElementById(foto_360).style.display = "none";
  document.getElementById(video).style.display = "none";
 

}function autoResize(iframe) {
    $(iframe).height($(iframe).contents().find('html').height());
}
