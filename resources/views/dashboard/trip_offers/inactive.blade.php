@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        <ul class="subonglet">
            <li class="onglet col m3 s12"><a href="{{ url('/home') }}">Tableau de bord</a></li>
            <li class="onglet col m3 s12"><a class="active" href="{{ url('/trip-offers') }}">Mes annonces</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/ratings') }}">Avis</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">Profil</a></li>
        </ul>
    </div>

    <div class="col m3 s12">
        <div class="collection">
            <a href="{{ url('/trip-offers/active') }}" class="collection-item text-primary">Trajets à venir</a>
            <a href="{{ url('/trip-offers/inactive') }}" class="collection-item active bg-primary">Trajets passés</a>
        </div>
    </div>

    <div class="col m9 s12">
        <div class="card">
            <div class="card-content">
                <h3>Mes annonces passées</h3>
                <div>
                    @forelse($trajets as $trajet)
                        <div class="row">
                            <div class="card card-giddy col l6 s12">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col m3 s12 center-align">

                                        </div>
                                        <div class="col m9 s12 center-align">
                                            <p class="card-title ">{{ $trajet->trajet_date }} à {{ $trajet->trajet_heure }}</p>
                                            <p class="text-important"> </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Vous n'avez aucune annonce.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
