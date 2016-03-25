@extends('layouts.app')

@section('content')
<div class="row">
    <div id="map" class="col m6"></div>
    <div class="col s6">
        <div class="card">
            <div class="card-content">
                {{ Form::open(array('url' => '/create-trip')) }}
                <h3>Itinéraire</h3>

                <div class="row">
                    <div class="input-field col s12">
                        <input type="checkbox"  checked id="auto" value="true" name="autoroute" class="filled-in"/>
                        <label for="auto">Autoroute</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="fa fa-location-arrow prefix"></i>
                        {{ Form::text('ville_depart', null, array('class'=>'validate', 'id'=>'start')) }}
                        {{ Form::label('ville_depart','Ville de départ') }}
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="fa fa-flag-checkered prefix"></i>
                        {{ Form::text('ville_arrivee', null, array('class'=>'validate', 'id'=>'end')) }}
                        {{ Form::label('ville_arrivee','Ville d\'arrivée') }}
                    </div>
                </div>
                <h4>Étapes:</h4>
                <div id="waypoints"></div>
                <button type="button" class="btn btn-secondary" onclick="addWaypoint();"><i class="material-icons right">add_circle</i>Ajouter une étape</button>
                <div id="directions-panel"></div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <h3>Date & Horaire</h3>

                <div class="row">
                    <div class="input-field col s12">
                        <input type="checkbox" id="ar" value="ar" name="aller_retour" class="filled-in"/>
                        <label for="ar">Aller-retour</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::label('date_depart','Date aller') }}
                        {{ Form::date('date_depart',null,array('class'=>'datepicker')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        {{ Form::label('heure','Heure') }}

                        <input type="time" name="heure" id="heure">
                    </div>
                </div>

                <div id="retour"></div>
            </div>

            <div class="row">
                <div class="input-field">
                    <button class="btn waves-effect waves-light btn-primary col s12" type="submit" name="action">Suivant </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{ Form::close() }}

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
var autoroute = false;
$('#auto').change(function(){
    if(document.getElementById('auto').checked){
        autoroute = false;
    }else{
        autoroute = true;
    }
});

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
                avoidHighways : autoroute, //autoroute
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

var compteur = 0;
function addWaypoint(){
    var divEtape = document.createElement('div');
    divEtape.setAttribute('class','row');
    var divInput = document.createElement('div');
    divInput.setAttribute('class','input-field col s10');

    var etape = document.createElement('input');
    etape.setAttribute('type','text');
    etape.setAttribute('class','etapes validate');
    etape.setAttribute('name','etape'+compteur);
    etape.setAttribute('id','etape'+compteur);

    var label = document.createElement('label');
    label.setAttribute('for','etape');
    label.appendChild(document.createTextNode('Ville étape'));

    var btn_supp = document.createElement('button');
    var text_btn = document.createElement('i');
    text_btn.setAttribute('class','material-icons right');
    text_btn.appendChild(document.createTextNode('clear'));
    btn_supp.appendChild(text_btn);
    btn_supp.setAttribute('onclick','removeWaypoint(this)');
    btn_supp.setAttribute('class','btn btn-third col s1');

    divInput.appendChild(etape);
    divInput.appendChild(label);

    divEtape.appendChild(divInput);
    divEtape.appendChild(btn_supp);

    document.getElementById('waypoints').appendChild(divEtape);

    document.getElementById('etape'+compteur).addEventListener('change', function() {
        calculateAndDisplayRoute(directionsService, directionsDisplay);
    });

    compteur++;
}

function removeWaypoint(n){
    n.parentNode.remove();
    compteur--;
    calculateAndDisplayRoute(directionsService, directionsDisplay);

}

$('#ar').change(function(){
    if($('#ar').is(':checked')){

        var ch = '<div class="row"><div class="input-field col s12">'+
                '{{ Form::label("retour","Date retour") }}'+
                '{{ Form::date("retour",null,array("class"=>"datepicker, retour")) }}'+
            '</div> </div> <div class="row"> <div class="col s6">' +
                '{{ Form::label("heure_retour","Heure") }}'+
                '{{ Form::selectRange("heure",00,23) }}'+
            '</div> <div class="col s6">'+
                '{{ Form::label("heure_retour","Minute") }}'+
                '{{ Form::selectRange("minute",00,59) }}'+
           '</div> </div>';



        document.getElementById('retour').innerHTML = ch;

        $('select').material_select();


        $('.retour').pickadate({
                    selectMonths: true, // Creates a dropdown to control month
                    selectYears: 5,// Creates a dropdown of 15 years to control year
                    min: true,
                });
    }else{
        document.getElementById('retour').innerHTML="";
 }
})

</script>
@endsection
