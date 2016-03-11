@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <ul class="subonglet">
                <li class="onglet col s3"><a href="{{ url('/home') }}">Tableau de bord</a></li>
                <li class="onglet col s3"><a href="{{ url('/trip-offers/active') }}">Mes annonces</a></li>
                <li class="onglet col s3"><a class="active" href="{{ url('/bookings') }}">Mes réservations</a></li>
                <li class="onglet col s3"><a href="{{ url('/ratings') }}">Avis</a></li>
                <li class="onglet col s3"><a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">Profil</a></li>
            </ul>
        </div>


        <div class="col s3">
            <div class="collection">
                <a href="{{ url('/bookings') }}" class="collection-item active red darken-3">En cours</a>
                <a href="{{ url('/bookings/history') }}" class="collection-item red-text text-darken-3">Historique</a>
            </div>
        </div>

        <div class="col s9">

            <h4>Mes réservations</h4>

            <div>
                @forelse($reservations as $reservation)
                    <li>{{ $reservation->trajet_id }}</li>
                @empty
                    <p>Vous n'avez aucune réservation.</p>
                @endforelse
            </div>

        </div>
    </div>

@endsection
