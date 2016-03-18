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
                <h3>Mes annonces</h3>

                @if(Auth::user()->site_id == null)
                <p class="alert alert-warning">Vous devez ajouter un site de formation avant de pouvoir créer une annonce !</p>
                @endif

                @if($nbVehicule == 0)
                <div>Vous devez <a href="{{ url('/profile/car/create') }}" class="link">ajouter un véhicule</a> avant de pouvoir créer une annonce !</div>
                @endif

                <a href="{{ url('trip-offers/create') }}" class="waves-effect waves-light btn red darken-3"><i class="material-icons left">add_location</i>Publier une annonce</a>


                <div>
                    @forelse($trajets as $trajet)
                        <div class="row">
                            <div class="card card-giddy col l6 s12">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s12 center-align">
                                            <p class="card-title ">{{ $trajet->depart }} <i class="material-icons">arrow_forward</i> {{ $trajet->arrivee }}</p>
                                            <p>{{ date('d F Y',strtotime($trajet->trajet_date)) }} à {{ date('H:i',strtotime($trajet->trajet_heure)) }}</p>
                                            <p>{{ $trajet->marque }} {{ $trajet->modele }}</p>
                                            <p>{{ $trajet->trajet_place }} places</p>
                                            <p>{{ $trajet->trajet_tarif }}€ par passager</p>

                                            <a href="{{ url('trip-offers/'.$trajet->trajet_id) }}" class="waves-effect waves-light btn"><i class="material-icons left">remove_red_eye</i>Voir l'annonce</a>

                                            <a class="waves-effect waves-light btn"><i class="material-icons left">airline_seat_recline_normal</i>Voir vos passagers</a>

                                            <a class="waves-effect waves-light btn"><i class="material-icons left">settings</i>Modifier</a>

                                            <a class="waves-effect waves-light btn"><i class="material-icons left">clear</i>Supprimer</a>


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
