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
            <a href="{{ url('/trip-offers') }}" class="collection-item active bg-primary">Trajets à venir</a>
            <a href="{{ url('/trip-offers-inactive') }}" class="collection-item text-primary">Trajets passés</a>
        </div>
    </div>

    <div class="col m9 s12">
        <div class="card">
            <div class="card-content">
                <h2>Mes annonces</h2>

                @if(Auth::user()->site_id == null)
                <p class="alert alert-warning">Vous devez ajouter un site de formation avant de pouvoir créer une annonce !</p>
                @endif

                @if($nbVehicule == 0)
                <div>Vous devez <a href="{{ url('/profile/car/create') }}" class="link">ajouter un véhicule</a> avant de pouvoir créer une annonce !</div>
                @endif

                @forelse($trajets as $trajet)
                <div class="row">
                    <div class="card card-giddy col l6 m12">
                        <div class="card-content row">
                            <div class="col l6 s12">
                                <h4>{{ $trajet->depart }} <i class="material-icons icon-valign">arrow_forward</i> {{ $trajet->arrivee }}</h4>
                                <h5>{{ date('d F Y',strtotime($trajet->trajet_date)) }} à {{ date('H:i',strtotime($trajet->trajet_heure)) }}</h5>
                                <div class="card card-info col s6">
                                    <div class="card-content center-align">
                                        <i class="material-icons">airline_seat_recline_normal</i><br>
                                        {{ $trajet->trajet_place }} places
                                    </div>
                                </div>
                                <div class="card card-info col s6">
                                    <div class="card-content center-align">
                                        <i class="material-icons">euro_symbol</i><br>
                                        {{ $trajet->trajet_tarif }}€
                                    </div>
                                </div>
                                <div class="card card-info col s12">
                                    <div class="card-content center-align">
                                        <i class="material-icons">directions_car</i><br>
                                        {{ $trajet->marque }}<br>{{ $trajet->modele }}
                                    </div>
                                </div>
                            </div>
                            <div class="col l6 s12">
                                <a class="waves-effect waves-light btn btn-secondary col s12"><i class="material-icons left">remove_red_eye</i>Voir l'annonce</a>
                                <a class="waves-effect waves-light btn btn-secondary col s12"><i class="material-icons left">airline_seat_recline_normal</i>Passagers</a>
                                <a class="waves-effect waves-light btn btn-secondary col s12"><i class="material-icons left">settings</i>Modifier</a>
                                <a class="waves-effect waves-light btn btn-third col s12"><i class="material-icons left">clear</i>Supprimer</a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="alert alert-info">Vous n'avez aucune annonce.</p>
            @endforelse
        </div>
    </div>
</div>
</div>
@endsection
