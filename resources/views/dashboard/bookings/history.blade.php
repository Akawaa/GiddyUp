@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        <ul class="subonglet">
            <li class="onglet col s3"><a href="{{ url('/home') }}">Tableau de bord</a></li>
            <li class="onglet col s3"><a href="{{ url('/trip-offers') }}">Mes annonces</a></li>
            <li class="onglet col s3"><a class="active" href="{{ url('/bookings') }}">Mes réservations</a></li>
            <li class="onglet col s3"><a href="{{ url('/ratings') }}">Avis</a></li>
            <li class="onglet col s3"><a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">Profil</a></li>
        </ul>
    </div>


    <div class="col m3 s12">
        <div class="collection">
            <a href="{{ url('/bookings') }}" class="collection-item text-primary">En cours</a>
            <a href="{{ url('/bookings-history') }}" class="collection-item active bg-primary">Historique</a>
        </div>
    </div>

    <div class="col m9 s12">
        <div class="card">
            <div class="card-content">
                <h3>Mes réservations</h3>
                @forelse($reservations as $reservation)
                    <a href="{{ url('bookings/'.$reservation->trajet_id) }}" class="trajet-link">
                        <div class="row">
                            <div class="col s12 m10">
                                <div class="card trajet-link-card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col l3 center-align">
                                                @if($reservation->membre_photo != null & $reservation->membre_photo_valide == 1)
                                                    <img src="{{ asset('img/uploads/'.$reservation->id.'/'.$reservation->membre_photo) }}" class="responsive-img circle" width="100px">
                                                @else
                                                    <i class="material-icons icon-valign large">photo_camera</i>
                                                @endif
                                                <p class="center-align">{{ $reservation->membre_prenom }} {{ $reservation->name[0] }} ({{ date('Y')-$reservation->membre_annee_naissance }} ans)</p>

                                                <div class="row">
                                                    <div class="col s2 offset-s2">
                                                        @if($reservation->membre_pref_dis != '')
                                                            @if($reservation->membre_pref_dis == 1)
                                                                <img src="{{ asset('img/preferences/discussion1.png') }}" class="responsive-img">
                                                            @elseif($reservation->membre_pref_dis == 2)
                                                                <img src="{{ asset('img/preferences/discussion2.png') }}" class="responsive-img">
                                                            @else
                                                                <img src="{{ asset('img/preferences/discussion3.png') }}" class="responsive-img">
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <div class="col s2">
                                                        @if($reservation->membre_pref_mus != '')
                                                            @if($reservation->membre_pref_mus == 1)
                                                                <img src="{{ asset('img/preferences/musique1.png') }}" class="responsive-img">
                                                            @elseif($reservation->membre_pref_mus == 2)
                                                                <img src="{{ asset('img/preferences/musique2.png') }}" class="responsive-img">
                                                            @else
                                                                <img src="{{ asset('img/preferences/musique3.png') }}" class="responsive-img">
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <div class="col s2">
                                                        @if($reservation->membre_pref_cig != '')
                                                            @if($reservation->membre_pref_cig == 1)
                                                                <img src="{{ asset('img/preferences/cigarette1.png') }}" class="responsive-img">
                                                            @elseif($reservation->membre_pref_cig == 2)
                                                                <img src="{{ asset('img/preferences/cigarette2.png') }}" class="responsive-img">
                                                            @else
                                                                <img src="{{ asset('img/preferences/cigarette3.png') }}" class="responsive-img">
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <div class="col s2">
                                                        @if($reservation->membre_pref_ani != '')
                                                            @if($reservation->membre_pref_ani == 1)
                                                                <img src="{{ asset('img/preferences/animal1.png') }}" class="responsive-img">
                                                            @elseif($reservation->membre_pref_ani == 2)
                                                                <img src="{{ asset('img/preferences/animal2.png') }}" class="responsive-img">
                                                            @else
                                                                <img src="{{ asset('img/preferences/animal3.png') }}" class="responsive-img">
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col l6">
                                                <div class="row">
                                                    @if($reservation->inscription_valide == 0)
                                                        <div class="col l12 alert alert-warning">
                                                            EN ATTENTE
                                                        </div>
                                                    @else
                                                        <div class="col l12 alert alert-success">
                                                            CONFIRMÉE
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="row">
                                                    <span class="card-title">{{ date('d F Y',strtotime($reservation->trajet_date)) }}, {{ date('H',strtotime($reservation->trajet_heure)) }}h{{ date('i',strtotime($reservation->trajet_heure)) }}</span>
                                                    <p>@foreach($etapes as $etape)
                                                            @if($etape->trajet_id == $reservation->trajet_id)
                                                                @if($etape->etape_ordre != 1)
                                                                    <i class="material-icons icon-valign">arrow_forward</i>
                                                                @endif
                                                                {{ $etape->ville_nom_reel }}

                                                            @endif
                                                        @endforeach</p>
                                                    <p>Véhicule : {{ $reservation->marque_libelle }} {{ $reservation->modele_libelle }} - {{ $reservation->vehicule_confort }}<i class="material-icons icon-valign">stars</i></p>
                                                </div>
                                            </div>

                                            <div class="col l3 center-align">

                                                <div class="card-action">
                                                    @foreach($prix as $prixEtape)
                                                        @if($prixEtape['item']['trajet_id'] == $reservation->trajet_id)
                                                            <h3>{{ $prixEtape['item']['prix'] }}€</h3>
                                                            <h4>par place</h4>
                                                        @endif
                                                    @endforeach
                                                </div>

                                                <div class="card-action">
                                                    @foreach($places as $place)
                                                        @if($place['item']['trajet_id'] == $reservation->trajet_id)
                                                            @if($reservation->trajet_place == $place['item']['nbPlace'] )
                                                                <h3>Complet</h3>
                                                            @elseif($place['item']['nbPlace'] ==0)
                                                                <h3>{{ $reservation->trajet_place}}</h3>
                                                                <h4>places disponibles</h4>
                                                            @else
                                                                <h3>{{ $reservation->trajet_place-$place['item']['nbPlace'] }}</h3>
                                                                <h4>places disponibles</h4>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="alert alert-info">Vous n'avez aucune réservation.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
