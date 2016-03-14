@extends('layouts.app')

@section('content')
    <style>
        #map {
            height: 500px;
            width: auto;
        }
        #right-panel {
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }

        #right-panel select, #right-panel input {
            font-size: 15px;
        }

        #right-panel select {
            width: 100%;
        }

        #right-panel i {
            font-size: 12px;
        }

        #right-panel {
            margin: 20px;
            border-width: 2px;
            width: 20%;
            text-align: left;
            padding-top: 20px;
        }
        #directions-panel {
            margin-top: 20px;
            background-color: #cbcbcb;
            padding: 10px;
        }
    </style>

    <div id="map"></div>
    <div id="right-panel">
        <div>
            <b>Ville de départ :</b>
            <input type="text" id="start" placeholder="ex. : Toronto">
            <br>
            <b>Étapes:</b> <br>
            <div id="waypoints"></div>
            <button onclick="addWaypoint();">Ajouter une étape</button>
            <br>
            <b>Ville d'arrivée :</b>
            <input type="text" id="end" placeholder="ex. : Toronto">
            <br>
            <input type="submit" id="submit">
        </div>
        <div id="directions-panel"></div>
    </div>

@endsection

@section('map')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcFXAOF5-waSJtu1bgXhQ1-EkPcPFboUA&signed_in=true&callback=initMap" async defer></script>

    <script>

        function initMap() {

            //var villeDepart = new google.maps.places.Autocomplete(document.getElementById(""));


            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer({
                draggable: false
                    });
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: {lat: 48.86, lng: 2.34} //Paris
            });
            directionsDisplay.setMap(map);

            document.getElementById('submit').addEventListener('click', function() {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            });
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            var waypts = [];
            var etapes = document.getElementsByClassName('etapes');
            for (var i = 0; i < etapes.length; i++) {
                waypts.push({
                    location: etapes[i].value,
                    stopover: true
                });

            }

            directionsService.route({
                origin: document.getElementById('start').value, //départ
                destination: document.getElementById('end').value, //arrivée
                waypoints: waypts, //étapes
                optimizeWaypoints: true, //optimisation des étapes
                travelMode: google.maps.TravelMode.DRIVING, //en voiture
                avoidHighways : true, //autoroute
            }, function(response, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                    var route = response.routes[0];
                    var summaryPanel = document.getElementById('directions-panel');
                    summaryPanel.innerHTML = '';
                    // For each route, display summary information.
                    for (var i = 0; i < route.legs.length; i++) {
                        var routeSegment = i + 1;
                        summaryPanel.innerHTML += '<b>Segment: ' + routeSegment +
                                '</b><br>';
                        summaryPanel.innerHTML += route.legs[i].start_address + ' à ';
                        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
                        summaryPanel.innerHTML += route.legs[i].duration.text + '<br>';
                        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
                    }
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }

        function addWaypoint(){
            var divEtape = document.createElement('div');
            var etape = document.createElement('input');
            etape.setAttribute('type','texte');
            etape.setAttribute('class','etapes');

            var btn_supp = document.createElement('button');
            var lb_supp = document.createTextNode('-');

            btn_supp.appendChild(lb_supp);
            btn_supp.setAttribute('onclick','removeWaypoint(this)');

            divEtape.appendChild(etape);
            divEtape.appendChild(btn_supp);

            document.getElementById('waypoints').appendChild(divEtape);
        }

        function removeWaypoint(n){
            n.parentNode.remove();
        }

    </script>
@endsection