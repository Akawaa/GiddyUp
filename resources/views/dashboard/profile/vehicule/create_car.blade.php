@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        <ul class="subonglet">
            <li class="onglet col s3"><a href="{{ url('/home') }}">Tableau de bord</a></li>
            <li class="onglet col s3"><a href="{{ url('/trip-offers') }}">Mes annonces</a></li>
            <li class="onglet col s3"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
            <li class="onglet col s3"><a href="{{ url('/ratings') }}">Avis</a></li>
            <li class="onglet col s3"><a class="active" href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">Profil</a></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col m3 s12">
        <div class="collection">
            <a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Informations personnelles</a>
            <a href="{{ url('/profile/university/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Université</a>
            <a href="{{ url('/profile/picture/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Photo</a>
            <a href="{{ url('/profile/preferences/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Préférence</a>
            <a href="{{ url('/profile/car') }}" class="collection-item bg-primary active">Véhicule</a>
            <a href="{{ url('/profile/email/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer d'adresse email</a>
            <a href="{{ url('/profile/password/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer de mot de passe</a>            </div>
        </div>

        <div class="col m9 s12">
            <div class="card">
                <div class="card-content">
                    <h3>Ajouter un véhicule</h3>
                    {{ Form::open(array('url' => '/profile/car')) }}

                    {{ Form::hidden('id',Auth::user()->id   ) }}

                    <div class="row">
                        <div class="input-field col s12 l6">
                            <i class="material-icons prefix">directions_car</i>
                            <select id="type" name="type">
                                <option value="" disabled selected>Type</option>

                                @foreach($types as $type)
                                <option value="{{ $type->type_id }}">{{ $type->type_libelle }}</option>
                                @endforeach

                            </select>
                            <label for="type">Type de véhicule</label>

                            @if ($errors->first('type'))
                            <span class="help-block">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                            @endif

                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 l6">
                            <i class="material-icons prefix">directions_car</i>
                            <select id="marque" name="marque">
                                <option value="" disabled selected>Marque</option>
                            </select>

                            @if ($errors->first('marque'))
                            <span class="help-block">
                                <strong>{{ $errors->first('marque') }}</strong>
                            </span>
                            @endif
                            <label for="marque">Marque</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 l6">
                            <i class="material-icons prefix">directions_car</i>
                            <select id="modele" name="modele">
                                <option value="" disabled selected>Modèle</option>
                            </select>
                            <label for="modele">Modèle</label>

                            @if ($errors->first('modele'))
                            <span class="help-block">
                                <strong>{{ $errors->first('modele') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 l6">
                            <i class="material-icons prefix">color_lens</i>
                            <select id="couleur" name="couleur">
                                <option value="" disabled selected>Couleur</option>

                                @foreach($couleurs as $couleur)
                                <option value="{{ $couleur->couleur_id }}">{{ $couleur->couleur_libelle }}</option>
                                @endforeach

                            </select>
                            <label for="couleur">Couleur</label>

                            @if ($errors->first('couleur'))
                            <span class="help-block">
                                <strong>{{ $errors->first('couleur') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 l6">
                            <i class="material-icons prefix">supervisor_account</i>
                            {{ Form::selectRange('place',1,9,4) }}
                            {{ Form::label('place','Place dans le véhicule ( incluant le conducteur )') }}

                            @if ($errors->first('place'))
                            <span class="help-block">
                                <strong>{{ $errors->first('place') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 l6">
                            <i class="material-icons prefix">stars</i>
                            {{ Form::select('confort',array('1'=>'Basique','2'=>'Normal','3'=>'Confort','4'=>'Luxe'),2) }}
                            {{ Form::label('confort','Confort') }}

                            @if ($errors->first('confort'))
                            <span class="help-block">
                                <strong>{{ $errors->first('confort') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        {{ Form::button('Ajouter',['class'=>'waves-effect waves-light btn btn-primary','type'=>'submit']) }}
                        <a href="{{ url('profile/car') }}" class="waves-effect waves-light btn btn-third">Annuler</a>
                    </div>

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

$('select').material_select();


$('#type').change(function(){
$.ajax({
url: 'getMarque',
type: "post",
data: {'type':$('#type').val()},
dataType: 'json',
success: function(data){

$('#marque').text('');
$('#modele').text('');
$('#modele').append('<option value="" disabled selected>Modèle</option>');
$('#marque').append('<option value="" disabled selected>Marque</option>');

$('select').material_select();

for(var i=0;i<data.length;i++){
$('#marque').append('<option value="'+data[i].marque_id+'">'+data[i].marque_libelle+'</option>')
}

$('select').material_select();

},
error: function(){
alert("Oups ! Une erreur s'est produite.");
}
});
});

$('#marque').change(function(){
$.ajax({
url: 'getModele',
type: "post",
data: {'marque':$('#marque').val()},
dataType: 'json',
success: function(data){

$('#modele').text('');
$('#modele').append('<option value="" disabled selected>Modèle</option>');

$('select').material_select();

for(var i=0;i<data.length;i++){
$('#modele').append('<option value="'+data[i].modele_id+'">'+data[i].modele_libelle+'</option>')
}
$('select').material_select();

},
error: function(){
alert("Oups ! Une erreur s'est produite.");
}
});
});

@endsection
