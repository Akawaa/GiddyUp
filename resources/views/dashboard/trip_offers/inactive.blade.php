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
            <a href="{{ url('/trip-offers') }}" class="collection-item text-primary">Trajets à venir</a>
            <a href="{{ url('/trip-offers-inactive') }}" class="collection-item active bg-primary">Trajets passés</a>
        </div>
    </div>

    <div class="col m9 s12">
        <div class="card">
            <div class="card-content">
                <h3>Mes annonces passées</h3>
                <div class="row">
                    @forelse($trajets as $trajet)
                    <div class="card card-giddy col l7 s12">
                        <div class="card-content">
                            <div class="row">
                                <div class="col s12">
                                    <h4>{{ $trajet->depart }} <i class="material-icons icon-valign">arrow_forward</i> {{ $trajet->arrivee }}</h4>
                                    <h5>{{ date('d F Y',strtotime($trajet->trajet_date)) }} à {{ date('H:i',strtotime($trajet->trajet_heure)) }}</h5>
                                    <div class="card card-info col s6 m4">
                                        <div class="card-content center-align">
                                            <i class="material-icons">airline_seat_recline_normal</i><br>
                                            {{ $trajet->trajet_place }} places
                                        </div>
                                    </div>
                                    <div class="card card-info col s6 m4">
                                        <div class="card-content center-align">
                                            <i class="material-icons">euro_symbol</i><br>
                                            {{ $trajet->trajet_tarif }}€
                                        </div>
                                    </div>
                                    <div class="card card-info col s12 m4">
                                        <div class="card-content center-align">
                                            <i class="material-icons">directions_car</i><br>
                                            {{ $trajet->marque }} {{ $trajet->modele }}
                                        </div>
                                    </div>
                                    <a href="{{ url('trip-offers/'.$trajet->trajet_id) }}" class="waves-effect waves-light btn btn-secondary col s5"><i class="material-icons left">remove_red_eye</i>Voir l'annonce</a>
                                    <a class="waves-effect waves-light btn btn-secondary col s5"><i class="material-icons left">redo</i>Republier</a>
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
