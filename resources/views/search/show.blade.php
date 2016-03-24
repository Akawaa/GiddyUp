@extends('layouts.app')


@section('content')
<div class="container">
    <h3>Résultat de votre recherche <a href="{{ url('search') }}" class="btn">Nouvelle recherche</a></h3>

    @forelse($recherche as $resultat)
        <div class="row">
            <div class="col s12 m10">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col l3 center-align">
                                <img src="{{ asset('img/uploads/'.$resultat->id.'/'.$resultat->membre_photo) }}" class="responsive-img circle" width="100px">
                                <p class="center-align">{{ $resultat->membre_prenom }} {{ $resultat->name[0] }} ({{ date('Y')-$resultat->membre_annee_naissance }} ans)</p>

                                <div class="row">
                                    <div class="col s2 offset-s2">
                                        @if($resultat->membre_pref_dis != '')
                                            @if($resultat->membre_pref_dis == 1)
                                                <img src="{{ asset('img/preferences/discussion1.png') }}" class="responsive-img">
                                            @elseif($resultat->membre_pref_dis == 2)
                                                <img src="{{ asset('img/preferences/discussion2.png') }}" class="responsive-img">
                                            @else
                                                <img src="{{ asset('img/preferences/discussion3.png') }}" class="responsive-img">
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col s2">
                                        @if($resultat->membre_pref_mus != '')
                                            @if($resultat->membre_pref_mus == 1)
                                                <img src="{{ asset('img/preferences/musique1.png') }}" class="responsive-img">
                                            @elseif($resultat->membre_pref_mus == 2)
                                                <img src="{{ asset('img/preferences/musique2.png') }}" class="responsive-img">
                                            @else
                                                <img src="{{ asset('img/preferences/musique3.png') }}" class="responsive-img">
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col s2">
                                        @if($resultat->membre_pref_cig != '')
                                            @if($resultat->membre_pref_cig == 1)
                                                <img src="{{ asset('img/preferences/cigarette1.png') }}" class="responsive-img">
                                            @elseif($resultat->membre_pref_cig == 2)
                                                <img src="{{ asset('img/preferences/cigarette2.png') }}" class="responsive-img">
                                            @else
                                                <img src="{{ asset('img/preferences/cigarette3.png') }}" class="responsive-img">
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col s2">
                                        @if($resultat->membre_pref_ani != '')
                                            @if($resultat->membre_pref_ani == 1)
                                                <img src="{{ asset('img/preferences/animal1.png') }}" class="responsive-img">
                                            @elseif($resultat->membre_pref_ani == 2)
                                                <img src="{{ asset('img/preferences/animal2.png') }}" class="responsive-img">
                                            @else
                                                <img src="{{ asset('img/preferences/animal3.png') }}" class="responsive-img">
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col l6">
                                <span class="card-title">{{ date('d F Y',strtotime($resultat->trajet_date)) }}, {{ date('H',strtotime($resultat->trajet_heure)) }}h{{ date('i',strtotime($resultat->trajet_heure)) }}</span>
                                <p>@foreach($etapes as $etape)
                                    @if($etape->trajet_id == $resultat->trajet_id)
                                        @if($etape->etape_ordre != 1)
                                            <i class="material-icons icon-valign">arrow_forward</i>
                                        @endif
                                        {{ $etape->ville_nom_reel }}

                                    @endif
                                @endforeach</p>
                                <p>Véhicule : {{ $resultat->marque_libelle }} {{ $resultat->modele_libelle }} - {{ $resultat->vehicule_confort }}<i class="material-icons icon-valign">stars</i></p>
                            </div>

                            <div class="col l3 center-align">

                                @foreach($prix as $prixEtape)
                                    @if($prixEtape['item']['trajet_id'] == $resultat->trajet_id)
                                        <h3>{{ $prixEtape['item']['prix'] }}€</h3>
                                        <h4>par place</h4>
                                    @endif
                                @endforeach


                                @foreach($places as $place)
                                        @if($place['item']['trajet_id'] == $resultat->trajet_id)
                                                @if($resultat->trajet_place == $place['item']['nbPlace'] )
                                                    <h3>Complet</h3>
                                                @elseif($place['item']['nbPlace'] ==0)
                                                    <h3>{{ $resultat->trajet_place}}</h3>
                                                    <h4>places disponibles</h4>
                                                @else
                                                    <h3>{{ $resultat->trajet_place-$place['item']['nbPlace'] }}</h3>
                                                    <h4>places disponibles</h4>
                                                @endif
                                        @endif
                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        Il n'y a pas de voyage qui correspond à votre recherche.
        <a href="{{ url('/search') }}">Nouvelle recherche</a>
    @endforelse
</div>
@endsection