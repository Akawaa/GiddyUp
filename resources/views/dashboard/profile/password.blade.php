@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <ul class="subonglet">
                <li class="onglet col s3"><a href="{{ url('/home') }}">Tableau de bord</a></li>
                <li class="onglet col s3"><a href="{{ url('/trip-offers/active') }}">Mes annonces</a></li>
                <li class="onglet col s3"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
                <li class="onglet col s3"><a href="{{ url('/ratings') }}">Avis</a></li>
                <li class="onglet col s3"><a class="active" href="{{ url('/profile') }}">Profil</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col s3">
            <div class="collection">
                <a href="{{ url('/profile') }}" class="collection-item red-text text-darken-3">Informations personnelles</a>
                <a href="{{ url('/profile/university') }}" class="collection-item red-text text-darken-3">Université</a>
                <a href="{{ url('/profile/picture') }}" class="collection-item red-text text-darken-3">Photo</a>
                <a href="{{ url('/profile/preferences') }}" class="collection-item red-text text-darken-3">Préférence</a>
                <a href="{{ url('/profile/car') }}" class="collection-item red-text text-darken-3">Véhicule</a>
                <a href="{{ url('/profile/password') }}" class="collection-item active red darken-3">Changer de mot de passe</a>
            </div>
        </div>

        <div class="col s9">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <h5>Changer de mot de passe</h5>
                            <form method="post" action="{{ url('/profile/password') }}">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input id="password" name="password" type="password" class="validate">
                                        <label for="password">Nouveau mot de passe</label>
                                    </div>

                                    <div class="input-field col s6">
                                        <input id="password_confirmation" name="password_confirmation" type="password" class="validate">
                                        <label for="password_confirmation">Confirmation du nouveau mot de passe</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s6">
                                        <button type="submit" class="waves-effect waves-light btn red darken-4">
                                            Mettre à jour
                                        </button>
                                </div>
                            </form>
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
