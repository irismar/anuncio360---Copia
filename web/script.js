  ultimograu=0;

  foto=null;

  vai=false;

    function sensor() {

  if (typeof DeviceMotionEvent.requestPermission === 'function') {
      
    // Handle iOS 13+ devices.

    DeviceMotionEvent.requestPermission()

      .then((state) => {


        if (state === 'granted') {
         
          
          window.addEventListener('devicemotion');

        } else {
          console.error('Request to access the orientation was rejected');
        }
      })
      .catch(console.error);
  } else {
    // Handle regular non iOS 13+ devices.
    window.addEventListener('devicemotion');
  } }


                      
function desativar() {



 
  const alpha = null;

 
  const angulo= 0;
}

function iniciar() {
 
 
if(foto < 73){

  window.addEventListener('deviceorientation',iniciar);

   window.addEventListener('devicemotion',iniciar);

  const alpha = event.alpha;

 

  console.log(alpha);

  const angulo= Math.floor(alpha);

  document.getElementById("gamma").textContent=angulo;
 
  if(Math.abs(ultimograu - angulo) > 4){ ultimograu=angulo 

  foto++
  
 // var url_atual = window.location.href;
  var mystr = window.location.href;

//////////////////limpar url//////
var id_usuario = mystr.split("id=");
var url_id = id_usuario[1];
//Splitting it with : as the separator
       var limpar_id = url_id.split("&&code=");
       var id_limpo=limpar_id[0];

/////////////////////////////////////////////////

//////////////////limpar url//////
var id_anuncio = mystr.split("&&anuncio=");
var url_anuncio = id_anuncio[1];
//Splitting it with : as the separator
       var limpar_id_anuancio = url_anuncio.split("#");
       var id_anuncio_limpo=limpar_id_anuancio[0];

/////////////////////////////////////////////////


   takeSnapShot()
  }
  getElementById("ultimograu").value= ultimograu;
  


console.log(ultimograu)

}  else{



}


}


function loadCamera(){

    

  //Captura elemento de vídeo

  var video = document.getElementById("webCamera"); 

     

    //As opções abaixo são necessárias para o funcionamento correto no iOS

    video.setAttribute('autoplay', '');

      video.setAttribute('muted', '');

      video.setAttribute('playsinline', '');

      var mediaConfig =  { video:  { facingMode: { exact: "environment" }},

           frameRate: { ideal: 90 } ,              

        width: { ideal: 4096 },

        height: { ideal: 2160 }     
            };

   

  //Verifica se o navegador pode capturar mídia

  if (navigator.mediaDevices.getUserMedia) {

    navigator.mediaDevices.getUserMedia(mediaConfig)

    .then( function(stream) {

      //Definir o elemento víde a carregar o capturado pela webcam

      video.srcObject = stream;

    })

    .catch(function(error) {

      alert("Acesse no Iphone pelo safari... Falhou :'(");

    });

  }

}



function takeSnapShot(){

  //Captura elemento de vídeo

  var video = document.getElementById("webCamera");

      video.style.width = document.width + 'px';

        video.style.height = document.height + 'px';

  //Criando um canvas que vai guardar a imagem temporariamente

  var canvas = document.createElement('canvas');

 canvas.width = video.videoWidth;

    canvas.height = video.videoHeight;

  var ctx = canvas.getContext('2d');

  

  //Desnehando e convertendo as minensões

  ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

  

  //Criando o JPG

  var dataURI = canvas.toDataURL('image/jpeg'); //O resultado é um BASE64 de uma imagem.

  document.querySelector("#base_img").value = dataURI;

  

  sendSnapShot(dataURI); //Gerar Imagem e Salvar Caminho no Banco

}



function sendSnapShot(base64){  

 // var url_atual = window.location.href;
  var mystr = window.location.href;

//////////////////limpar url//////
var id_usuario = mystr.split("id=");
var url_id = id_usuario[1];
//Splitting it with : as the separator
       var limpar_id = url_id.split("&&code=");
       var id_limpo=limpar_id[0];

/////////////////////////////////////////////////

//////////////////limpar url//////
var id_anuncio = mystr.split("&&anuncio=");
var url_anuncio = id_anuncio[1];
//Splitting it with : as the separator
       var limpar_id_anuancio = url_anuncio.split("#");
       var id_anuncio_limpo=limpar_id_anuancio[0];

/////////////////////////////////////////////////



  foto2=foto+'id='+ id_anuncio_limpo+'id='+id_limpo;


  var request = new XMLHttpRequest();
  

    request.open('POST', 'save_photos.php?foto='+foto+'&&id_usuario='+id_limpo+'&&id_anuncio='+id_anuncio_limpo, true);

    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

    

    request.onload = function() {

      console.log(request);

      if (request.status >= 200 && request.status < 400) {

        //Colocar o caminho da imagem no SRC

        var data = JSON.parse(request.responseText);

        

        //verificar se houve erro

        if(data.error){

          alert(data.error);

          return false;

        }

        

        //Mostrar informações

           var ultima_foto=data.url;
        document.getElementById("foto").textContent=ultima_foto; 

     

if(ultima_foto > 72){
if (window.confirm('Cadastro Concuido Consucesso ')) 
{    
window.location.href='https://www.anuncio360.com/'+id_anuncio_limpo;

};
}





        //document.querySelector("#nome_foto").setAttribute("src", data.img);

        ///document.querySelector("#caminhoImagem a").setAttribute("href", data.img);

        ///document.querySelector("#caminhoImagem a").innerHTML = data.img.split("/")[1];

      } else {

        alert( "Erro ao salvar. Tipo:" + request.status );

      }

    };

    

    request.onerror = function() {

      alert("Erro ao salvar. Back-End inacessível.");

    }

    

    request.send("base_img="+base64); // Enviar dados

}




loadCamera();