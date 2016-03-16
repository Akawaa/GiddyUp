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

        <div class="row">

            {{ Form::open(array('url' => '/trajets/store')) }}
            <div class="col s6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Itinéraire</span>
                            <div>
                                <b>Ville de départ :</b>
                                <input type="text" name="ville_depart" id="start" placeholder="ex. : Paris">
                                <br>
                                <b>Ville d'arrivée :</b>
                                <input type="text" name="ville_arrivee" id="end" placeholder="ex. : Gap">
                                <br>
                                <br>
                                <b>Étapes:</b> <br>
                                <div id="waypoints"></div>
                                <button type="button" onclick="addWaypoint();">Ajouter une étape</button>
                            </div>
                        <div id="directions-panel"></div>
                    </div>
                </div>
            </div>

            <div class="col s6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Date & Horaire</span>

                        <div class="row">
                            <input type="checkbox" id="ar" value="ar" name="aller_retour"/>
                            <label for="ar">Aller-retour</label>
                        </div>

                        <div class="row">
                            {{ Form::label('date_depart','Date aller') }}
                            {{ Form::date('date_depart',null,array('class'=>'datepicker')) }}
                         </div>

                        <div class="row">
                            <div class="col s6">
                                {{ Form::label('heure','Heure') }}
                                {{ Form::selectRange('heure',00,23) }}

                            </div>
                            <div class="col s6">
                                {{ Form::label('minute','Minute') }}
                                {{ Form::selectRange('minute',00,59) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>

@endsection

@section('map')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcFXAOF5-waSJtu1bgXhQ1-EkPcPFboUA&signed_in=true&callback=initMap" async defer></script>

    <script>

        $('select').material_select();

        function initMap() {
            directionsService = new google.maps.DirectionsService;
            directionsDisplay = new google.maps.DirectionsRenderer({
                draggable: false
                    });
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: {lat: 48.86, lng: 2.34} //Paris
            });
            directionsDisplay.setMap(map);

            document.getElementById('end').addEventListener('change', function() {
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
            etape.setAttribute('type','text');
            etape.setAttribute('class','etapes');
            etape.setAttribute('name','etape');
            etape.setAttribute('id','etape');


            var btn_supp = document.createElement('button');
            var lb_supp = document.createTextNode('-');

            btn_supp.appendChild(lb_supp);
            btn_supp.setAttribute('onclick','removeWaypoint(this)');

            divEtape.appendChild(etape);
            divEtape.appendChild(btn_supp);

            document.getElementById('waypoints').appendChild(divEtape);

            document.getElementById('etape').addEventListener('change', function() {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            });
        }

        function removeWaypoint(n){
            n.parentNode.remove();
        }

        $('#ar').change(function(){
            if($('#ar').is(':checked')){
                var divRetour = document.createElement('div');
                divRetour.setAttribute('id','retour');

                var row = document.createElement('div');
                row.setAttribute('class','row');
                divRetour.appendChild(row);

                var lb_date = document.createElement('label');
                var text_lb_data = document.createTextNode('Date retour');
                lb_date.appendChild(text_lb_data);
                row.appendChild(lb_date);

                var date = document.createElement('input');
                date.setAttribute('type','date');
                date.setAttribute('class','retour');
                row.appendChild(date);

                var rowHeure = document.createElement('div');
                rowHeure.setAttribute('class','row');
                divRetour.appendChild(rowHeure);

                var col6 = document.createElement('div');
                col6.setAttribute('class','col s6');



                document.getElementsByClassName('card-content')[1].appendChild(divRetour);

                $('.retour').pickadate({
                    selectMonths: true, // Creates a dropdown to control month
                    selectYears: 5,// Creates a dropdown of 15 years to control year
                    min: true,
                });
            }else{
               $('#retour').remove();
            }
        })

    </script>
@endsection
