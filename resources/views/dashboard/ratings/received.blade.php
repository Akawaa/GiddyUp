@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        <ul class="subonglet">
            <li class="onglet col m3 s12"><a href="{{ url('/home') }}">Tableau de bord</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/trip-offers/active') }}">Mes annonces</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
            <li class="onglet col m3 s12"><a class="active" href="{{ url('/ratings') }}">Avis</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">Profil</a></li>
        </ul>
    </div>


    <div class="col m3 s12">
        <div class="collection">
            <a href="{{ url('/ratings') }}" class="collection-item text-primary">Laisser un avis</a>
            <a href="{{ url('/ratings/received') }}" class="collection-item active bg-primary">Avis reçus</a>
            <a href="{{ url('/ratings/given') }}" class="collection-item text-primary">Avis laissés</a>
        </div>
    </div>

    <div class="col m9 s12">
        <div class="card">
            <div class="card-content">
                <h3>Avis</h3>
            </div>
        </div>
    </div>
</div>
@endsection
