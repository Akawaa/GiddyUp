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
            <a href="{{ url('/profile/university/'.Auth::user()->id.'/edit') }}" class="collection-item active bg-primary">Université</a>
            <a href="{{ url('/profile/picture/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Photo</a>
            <a href="{{ url('/profile/preferences/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Préférences</a>
            <a href="{{ url('/profile/car') }}" class="collection-item text-primary">Véhicule</a>
            <a href="{{ url('/profile/email/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer d'adresse email</a>
            <a href="{{ url('/profile/password/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer de mot de passe</a>
        </div>
    </div>

    <div class="col m9 s12">
        <div class="card">
            <div class="card-content">
                <h3>Université</h3  >
                    @if (session('status'))
                    <p class="alert alert-success">
                        {{ session('status') }}
                    </p>
                    @endif

                    {{ Form::model($user, array('route' => array('profile.university.update',$user->id),'method'=>'PUT')) }}

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_balance</i>
                            <select name="universite" id="universite" class="icons">
                                <option value="0" disabled selected>Universite</option>
                                @foreach($universites as $universite)
                                <option class="red-text text-darken-4" data-icon="{{asset('img/logo_universites/'.$universite->universite_logo)}}" @if($universite->universite_id == $universiteCourante) selected @endif value="{{$universite->universite_id}}">{{$universite->universite_nom}}</option>
                                @endforeach
                            </select>

                            @if ($errors->first('universite'))
                            <span class="help-block">
                                <strong>{{ $errors->first('universite') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12" id="site_div">
                            <i class="material-icons prefix">place</i>
                            <select name="site" id="site">
                                <option value="0" disabled selected>Site</option>
                                @if(isset($sites))
                                @foreach($sites as $site)
                                <option class="red-text text-darken-4" @if($site->site_id == $siteCourant) selected @endif value="{{$site->site_id}}">{{$site->site_nom}}</option>
                                @endforeach
                                @endif
                            </select>

                            @if ($errors->first('site'))
                            <span class="help-block">
                                <strong>{{ $errors->first('site') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="waves-effect waves-light btn btn-primary col">
                            Mettre à jour
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

$('select').material_select();

$('#universite').change(function(){
$.ajax({
url: 'getSite',
type: "post",
data: {'universite':$('#universite').val()},
dataType: 'json',
success: function(data){

for(var i=0;i<data.length;i++){
$('#site').append('<option value="'+data[i].site_id+'">'+data[i].site_nom+'</option>')
}

$('select').material_select();

},
error: function(){
alert("Oups ! Une erreur s'est produite.");
}
});
});

@endsection
