  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
  <script src="https://apis.google.com/js/api:client.js"></script><script>
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '509308011440-j6dmfalodle58mndg6krt92golkk0omv.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachSignin(document.getElementById('customBtn'));
    });
  };

  function attachSignin(element) {
  
    auth2.attachClickHandler(element, {},
        function(googleUser) {
           var profile = googleUser.getBasicProfile();
            console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
            console.log('Name: ' + profile.getName());
            console.log('Image URL: ' + profile.getImageUrl());
            console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
             log('acesso sucesso login  social id= ' +profile.getId());
            window.location.href='https://www.anuncio360.com/360/login-social.php?id='+profile.getId()+'&&nome='+profile.getName()+'&&foto_perfil='+profile.getImageUrl()+'&&email='+profile.getEmail();
          document.getElementById('name').innerText = "Signed in: " +
              googleUser.getBasicProfile().getName();
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
  }
  </script>
  <meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css"  href="360/styles.css" />

     <meta name="google-signin-client_id" content="509308011440-j6dmfalodle58mndg6krt92golkk0omv.apps.googleusercontent.com">
   
    </head>
<body>
	    <div class="caixa_centro"><form action="/360/acao.php" method="post">

    <div class='login_container'>
    	
 <div class="login">  
 	
      <div class="topo_nome_login">  <input type="text" name="user" class="search-box_login"  placeholder="Nome Usuario">
                   
                </div> 

               
                 <div class="topo_nome_login">   <input type="password" name="senha" class="search-box_login"  placeholder="Senha">
                   
                </div> 
   

               
               

              <? if(isset( $_SESSION['erro'])){ ?>
                    <div class="caixa_erro_login"><a href="#"><?php echo  $_SESSION['erro'];?></a></div>

                    
             <? } ?>
                 
                     <div class="caixa">
                 <div class="caixa_rigth2"><a href="https://www.anuncio360.com/cadastro">Cadastrar</a></div>
                 <div class="caixa_rigth"><a href="#">Esquecir Senha</a></div>
                  
                 
                  
                 </div>


                     <div class="caixa">
                
 <div id="gSignInWrapper">
   
    <div id="customBtn" class="customGPlusSignIn">
      <span class="icon"></span>
      <span class="buttonText">Entrar com Google</span>
    </div>
  </div>
  <div id="name"></div>
 

                </div>
               
                  <input type=submit class="entrar" value="Entrar">
                
                 

                 

</div></div>
 </form> 
    </div>

</body>
</html>



 <script>startApp();</script>
     