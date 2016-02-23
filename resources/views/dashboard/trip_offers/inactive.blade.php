@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <ul class="subonglet">
                <li class="onglet col s3"><a href="{{ url('/home') }}">Tableau de bord</a></li>
                <li class="onglet col s3"><a class="active" href="{{ url('/trip-offers/active') }}">Mes annonces</a></li>
                <li class="onglet col s3"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
                <li class="onglet col s3"><a href="{{ url('/ratings') }}">Avis</a></li>
                <li class="onglet col s3"><a href="{{ url('/profile') }}">Profil</a></li>
            </ul>
        </div>


        <div class="col s3">
            <div class="collection">
                <a href="{{ url('/trip-offers/active') }}" class="collection-item red-text text-darken-3">Trajets à venir</a>
                <a href="{{ url('/trip-offers/inactive') }}" class="collection-item active red darken-3">Trajets passés</a>
            </div>
        </div>

        <div class="col s9">

            <h4>Mes annonces</h4>



        </div>

    </div>


@endsection
