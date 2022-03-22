_debug = false;

function dbg(msg) {
    if (_debug)
        console.log (msg);
}

$(document).ready(function() {
    doMouseWheel = 1 ;
    $("#postedComments").append( "<p id='last'></p>" );
    dbg("Document Ready");

    $(window).scroll(function() {
        dbg("Window Scroll Start");

        if (!doMouseWheel)
            return;

        var distanceTop = $('#last').offset().top - $(window).height();
        if  ($(window).scrollTop() > distanceTop) {
            dbg("Window distanceTop to scrollTop Start");
            $('div#loadMoreComments').show();
            doMouseWheel = 0 ;
            
            dbg("Another window to the end !!!! "+$(".postedComment:last").attr('id'));
            $.ajax({
                dataType : "html",
                url: "jquery-loadMoreComments.php?lastComment="+ $(".postedComment:last").attr('id'),
                success: function(html) {
                    doMouseWheel = 1 ;
                    if(html){
                        $("#postedComments").append(html);
                        dbg('Append html: ' + $(".postedComment:first").attr('id'));
                        dbg('Append html: ' + $(".postedComment:last").attr('id'));

                        $("#last").remove();
                        $("#postedComments").append( "<p id='last'></p>" );
                        $('div#loadMoreComments').hide();
                    } else {
                        //Disable Ajax when result from PHP-script is empty (no more DB-results )
                        $('div#loadMoreComments').replaceWith( "<center><h1 style='color:red'>End of countries !!!!!!!</h1></center>" );
                        doMouseWheel = 0 ;
                    }
                }
            });
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
 

}
var altura = window.screen.height;
var largura = window.screen.width;

console.log(largura);

