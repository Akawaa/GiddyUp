@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <ul class="subonglet">
                <li class="onglet col s3"><a href="{{ url('/home') }}">Tableau de bord</a></li>
                <li class="onglet col s3"><a href="{{ url('/trip-offers/active') }}">Mes annonces</a></li>
                <li class="onglet col s3"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
                <li class="onglet col s3"><a class="active" href="{{ url('/ratings') }}">Avis</a></li>
                <li class="onglet col s3"><a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">Profil</a></li>
            </ul>
        </div>


        <div class="col s3">
            <div class="collection">
                <a href="{{ url('/ratings') }}" class="collection-item red-text text-darken-3">Laisser un avis</a>
                <a href="{{ url('/ratings/received') }}" class="collection-item red-text text-darken-3">Avis reçus</a>
                <a href="{{ url('/ratings/given') }}" class="collection-item active red darken-3">Avis laissés</a>
            </div>
        </div>

        <div class="col s9">

            <h4>Avis</h4>

        </div>

    </div>

@endsection
