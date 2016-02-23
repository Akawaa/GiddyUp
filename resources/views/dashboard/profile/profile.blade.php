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

        <div class="col s3">
            <div class="collection">
                <a href="{{ url('/profile') }}" class="collection-item active red darken-3">Informations personnelles</a>
                <a href="{{ url('/profile') }}" class="collection-item red-text text-darken-3">Photo</a>
                <a href="{{ url('/profile') }}" class="collection-item red-text text-darken-3">Préférence</a>
                <a href="{{ url('/profile') }}" class="collection-item red-text text-darken-3">Véhicule</a>
                <a href="{{ url('/profile') }}" class="collection-item red-text text-darken-3">Changer de mot de passe</a>
            </div>
        </div>

        <div class="col s9">

            <h4>Profil</h4>

        </div>

    </div>
@endsection
