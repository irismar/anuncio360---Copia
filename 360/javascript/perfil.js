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
            url: "/360/post_perfil.php?lat="+lat+"&&lng="+lng+"&&perfil="+$(".id_perfil:last").attr('id')+"&&largura="+largura,
           success: function(html){
                 log('acesso sucesso Perfil index' +$(".id_perfil:last").attr('id')+'Com geolocation ATIVADO');
               $("#postedComments").html(html);
             }});   

    
             
    },
    function (error) {
     
      
     erro=true;
      $.ajax({
          dataType : "html",
          url: "/360/post_perfil_not_geo.php?lat=null&&lng=null&&perfil="+$(".id_perfil:last").attr('id')+"&&largura="+largura,
         success: function(html){
               log('acesso sucesso Perfil index' +$(".id_perfil:last").attr('id')+'Com geolocation DESATIVADO');
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

        var distanceTop = $('#last').offset().top - $(window).height()-300;
        if  ($(window).scrollTop() > distanceTop) {
            dbg("Window distanceTop to scrollTop Start");
            $('div#loadMoreComments').show();
            doMouseWheel = 0 ;
            
            dbg("Another window to the end !!!! "+$(".postedComment:last").attr('id'));
           ////////caso exista n]ao exista GEo
           console.log(erro)
           if(erro){  

            $.ajax({
              dataType : "html",
              url: "360/post_perfil_ultimos_not_geo.php?lastComment="+ $(".postedComment:last").attr('id')+"&&url_perfil="+ $(".url_perfil:last").attr('id')+"&&largura="+largura,
              success: function(html) {
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
                      $('div#loadMoreComments').replaceWith( "<center><div class='topo'>Fim</div>" );
                      doMouseWheel = 0 ;
                  }
              }
          });


             }else{  
     
            $.ajax({
                dataType : "html",
                url: "360/post_perfil_ultimos.php?lastComment="+ $(".postedComment:last").attr('id')+"&&url_perfil="+ $(".url_perfil:last").attr('id')+"&&lat="+$(".lat:last").attr('id')+"&&lng="+$(".lng:last").attr('id')+"&&largura="+largura,
                success: function(html) {
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
                        $('div#loadMoreComments').replaceWith( "<center><div class='topo'>Fim</div>" );
                        doMouseWheel = 0 ;
                    }
                }
            }); }
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
