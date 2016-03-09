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
                <a href="{{ url('/profile/picture/'.Auth::user()->id.'/edit') }}" class="collection-item active red darken-3">Photo</a>
                <a href="{{ url('/profile/preferences/'.Auth::user()->id.'/edit') }}" class="collection-item red-text text-darken-3">Préférences</a>
                <a href="{{ url('/profile/car') }}" class="collection-item red-text text-darken-3">Véhicule</a>
                <a href="{{ url('/profile/email/'.Auth::user()->id.'/edit') }}" class="collection-item red-text text-darken-3">Changer d'adresse email</a>
                <a href="{{ url('/profile/password/'.Auth::user()->id.'/edit') }}" class="collection-item red-text text-darken-3">Changer de mot de passe</a>            </div>
        </div>

        <div class="col s9">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <h5>Photo</h5>


                                <div class="row">
                                    <div class="col s8 center-align">

                                        @if(Auth::user()->membre_photo == null)
                                            <div class="left-align">
                                                Ajoutez votre photo ! Les autres membres seront rassurés de savoir avec
                                                qui ils voyageront et vous trouverez plus facilement un covoiturage.
                                                Les photos permettent aussi aux membres de se reconnaître.
                                            </div>

                                            <i class="material-icons large">add_a_photo</i>
                                            <h6>Ajoutez une photo</h6>
                                        @else
                                            @if(Auth::user()->membre_photo_valide == 0)
                                                <div>Votre photo est en cours de validation. Les membres ne peuvent pas encore la voir.</div>
                                            @endif

                                            <img class="responsive-img circle photo_profil" src="{{ asset('uploads/'.Auth::user()->id.'/'.Auth::user()->membre_photo) }}" alt="">
                                        @endif
                                    </div>
                                </div>

                                {{ Form::model($user, array('route' => array('profile.picture.update',$user->id),'method'=>'PUT','files' => true)) }}

                                <div class="row">
                                    <div class="file-field input-field col s8">
                                        <div class="btn amber">
                                            <span>File</span>
                                                {{ Form::file('photo_profil') }}

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
                                    <div>
                                        {{ Form::button('Mettre à jour',['class'=>'waves-effect waves-light btn red darken-4','type'=>'submit']) }}

                            {{ Form::close() }}

                                        @if(Auth::user()->membre_photo != null)
                                            {{ Form::open(array('url'=> 'profile/picture/'.Auth::user()->id)) }}
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

        </div>

    </div>
@endsection

@section('script')

    $('select').material_select();

@endsection
