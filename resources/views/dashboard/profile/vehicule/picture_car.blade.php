@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        <ul class="subonglet">
            <li class="onglet col s3"><a href="{{ url('/home') }}">Tableau de bord</a></li>
            <li class="onglet col s3"><a href="{{ url('/trip-offers/active') }}">Mes annonces</a></li>
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
            <a href="{{ url('/profile/preferences/'.Auth::user()->id.'/edit')  }}" class="collection-item text-primary">Préférence</a>
            <a href="{{ url('/profile/car') }}" class="collection-item bg-primary active">Véhicule</a>
            <a href="{{ url('/profile/email/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer d'adresse email</a>
            <a href="{{ url('/profile/password/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer de mot de passe</a>            </div>
        </div>

        <div class="col m9 s12">
            <div class="card">
                <div class="card-content">
                    <h3>Photo du Véhicule</h3>
                    <div class="row">
                        <div class="col s8 center-align">

                            @if($vehicule->vehicule_photo == null)
                            @if($vehicule->type_id == 0)
                            <i class="material-icons large">directions_car</i>
                            @else
                            <i class="material-icons large">motorcycle</i>
                            @endif

                            <h6>Ajoutez une photo</h6>
                            @else
                            <img class="circle photo_profil" src="{{ asset('uploads/'.Auth::user()->id.'/'.$vehicule->vehicule_photo) }}" alt="vehicule">
                            @endif
                        </div>
                    </div>

                    {{ Form::model($vehicule, array('route' => array('profile.car.picture.update',$vehicule->vehicule_id),'method'=>'PUT','files' => true)) }}

                    <div class="row">
                        <div class="file-field input-field col s8">
                            <div class="btn btn-secondary">
                                <span><i class="material-icons">add_a_photo</i></span>
                                {{ Form::file('photo_car') }}
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                            @if ($errors->first('photo_car'))
                            <span class="help-block">
                                <strong>{{ $errors->first('photo_car') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        {{ Form::button('Mettre à jour',['class'=>'waves-effect waves-light btn btn-primary col','type'=>'submit']) }}
                        <a href="{{ url('profile/car') }}" class="waves-effect waves-light btn btn-third col">Annuler</a>
                        {{ Form::close() }}
                        @if($vehicule->vehicule_photo != null)
                        {{ Form::open(array('url'=> 'profile/car/picture/'.$vehicule->vehicule_id)) }}
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
