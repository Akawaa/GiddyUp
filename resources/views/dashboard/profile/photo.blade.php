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
            <a href="{{ url('/profile/picture/'.Auth::user()->id.'/edit') }}" class="collection-item active bg-primary">Photo</a>
            <a href="{{ url('/profile/preferences/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Préférences</a>
            <a href="{{ url('/profile/car') }}" class="collection-item text-primary">Véhicule</a>
            <a href="{{ url('/profile/email/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer d'adresse email</a>
            <a href="{{ url('/profile/password/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer de mot de passe</a>            </div>
        </div>

        <div class="col m9 s12">
            <div class="card">
                <div class="card-content">
                    <h3>Photo</h3>
                    <div class="row">
                        <div class="col s8 center-align">
                            @if(Auth::user()->membre_photo == null)
                            <div class="left-align">
                                Ajoutez votre photo ! Les autres membres aiment voir avec
                                qui ils voyageront et vous trouverez plus facilement un covoiturage.
                                Les photos permettent aussi aux membres de se reconnaître.
                            </div>
                            @else
                            @if(Auth::user()->membre_photo_valide == 0)
                            <div>Votre photo est en cours de validation. Les membres ne peuvent pas encore la voir.</div>
                            @endif

                            <img class="responsive-img circle photo_profil" src="{{ asset('img/uploads/'.Auth::user()->id.'/'.Auth::user()->membre_photo) }}" alt="">
                            @endif
                        </div>
                    </div>

                    {{ Form::model($user, array('route' => array('profile.picture.update',$user->id),'method'=>'PUT','files' => true)) }}

                    <div class="row">
                        <div class="file-field input-field col s12">
                            <div class="btn btn-secondary">
                                <span><i class="material-icons">add_a_photo</i></span>
                                {{ Form::file('photo_profil',null,array('placeholder'=>'Ajoutez votre photo')) }}

                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>

                            @if ($errors->first('photo_profil'))
                            <span class="help-block">
                                <strong>{{ $errors->first('photo_profil') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        {{ Form::button('Mettre à jour',['class'=>'waves-effect waves-light btn btn-primary col','type'=>'submit']) }}

                        {{ Form::close() }}

                        @if(Auth::user()->membre_photo != null)
                        {{ Form::open(array('url'=> 'profile/picture/'.Auth::user()->id)) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::button('<i class="material-icons right">clear</i>Supprimer', ['class' => 'waves-effect waves-light btn btn-third col','type'=>'submit']) }}
                        {{ Form::close() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

$('select').material_select();

@endsection
