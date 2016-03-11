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
        <div class="col s3">
            <div class="collection">
                <a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}" class="collection-item red-text text-darken-3">Informations personnelles</a>
                <a href="{{ url('/profile/university/'.Auth::user()->id.'/edit') }}" class="collection-item red-text text-darken-3">Université</a>
                <a href="{{ url('/profile/picture/'.Auth::user()->id.'/edit') }}" class="collection-item red-text text-darken-3">Photo</a>
                <a href="{{ url('/profile/preferences/'.Auth::user()->id.'/edit')  }}" class="collection-item red-text text-darken-3">Préférence</a>
                <a href="{{ url('/profile/car') }}" class="collection-item red darken-3 active">Véhicule</a>
                <a href="{{ url('/profile/email/'.Auth::user()->id.'/edit') }}" class="collection-item red-text text-darken-3">Changer d'adresse email</a>
                <a href="{{ url('/profile/password/'.Auth::user()->id.'/edit') }}" class="collection-item red-text text-darken-3">Changer de mot de passe</a>            </div>
        </div>

        <div class="col s9">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <h5>Véhicule</h5>
                            <a href="{{ url('profile/car') }}" class="waves-effect waves-light btn red darken-4">Annuler</a>

                            <div class="row">
                                <div class="col s8 center-align">

                                    @if($vehicule->vehicule_photo == null)
                                        @if($vehicule->type_id == 1)
                                            <i class="material-icons large">directions_car</i>
                                        @else
                                            <i class="material-icons large">motorcycle</i>
                                        @endif

                                        <h6>Ajoutez une photo</h6>
                                    @else
                                        <img class="responsive-img circle photo_profil" src="{{ asset('img/uploads/'.Auth::user()->id.'/'.$vehicule->vehicule_photo) }}" alt="">
                                    @endif
                                </div>
                            </div>


                            {{ Form::model($vehicule, array('route' => array('profile.car.picture.update',$vehicule->vehicule_id),'method'=>'PUT','files' => true)) }}

                            <div class="row">
                                <div class="file-field input-field col s8">
                                    <div class="btn amber">
                                        <span>File</span>
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
                                <div>
                                    {{ Form::button('Mettre à jour',['class'=>'waves-effect waves-light btn red darken-4','type'=>'submit']) }}
                                </div>
                            </div>

                            {{ Form::close() }}

                            @if($vehicule->vehicule_photo != null)
                                {{ Form::open(array('url'=> 'profile/car/picture/'.$vehicule->vehicule_id)) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::button('Supprimer', ['class' => 'waves-effect waves-light btn red darken-4','type'=>'submit']) }}
                                {{ Form::close() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
