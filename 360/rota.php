<!DOCTYPE html> 
<html> 
<head> 
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
 
    <style type="text/css"> 
        * {  margin: 0px; padding: 0px }
        form input{
             
        }
        #mapview{ visibility: hidden;}
    </style>
 
    <link href="https://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
    <title>Colocando um como chegar/traçar rotas do google maps em seu site, por newmsade</title>
 
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript"> 
        var directionDisplay;
        var directionsService = new google.maps.DirectionsService();
        var map;
 
        function initialize() {
            directionsDisplay = new google.maps.DirectionsRenderer();
            var myLatlng = new google.maps.LatLng();
             
            var myOptions = {
                zoom:7,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: myLatlng
            }
 
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            directionsDisplay.setMap(map);
            directionsDisplay.setPanel(document.getElementById("directionsPanel"));
        }
 
        function calcRoute() {
            var start = document.getElementById("endereco").value;
            var end = document.getElementById("destino").value;
            var request = {
                origin:start, 
                destination:end,
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            };
             
            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                } else {
                    alert(status);
                }
 
                document.getElementById('mapview').style.visibility = 'visible';
            });
        }
    </script>
</head> 
<body onload="initialize()">
 
<form action="javascript: void(0);" onSubmit="calcRoute()">
    <div>
        Destino: <input type="text" size="50" value="Rua João Pedroso - SBO" id="destino" />
    </div>
     
    <div>
        Origem: <input type="text" size="50" value="americana" id="endereco" />
    </div>
    <button type="submit">Como chegar?</button>
</form>
 
<div id="mapview">
    <div id="map_canvas" style="float: left; width: 500px; height: 340px;"></div>
    <div class="direcao" style="float: left; width: 500px; height: 340px; overflow: scroll;">
        <div id="directionsPanel" style="width: 480px;height 100px"></div>
    </div>
</div>
</body> 
</html>