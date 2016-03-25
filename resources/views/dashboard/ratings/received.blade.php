@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        <ul class="subonglet">
            <li class="onglet col m3 s12"><a href="{{ url('/home') }}">Tableau de bord</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/trip-offers') }}">Mes annonces</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
            <li class="onglet col m3 s12"><a class="active" href="{{ url('/ratings') }}">Avis</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">Profil</a></li>
        </ul>
    </div>


    <div class="col m3 s12">
        <div class="collection">
            <a href="{{ url('/ratings') }}" class="collection-item text-primary">Laisser un avis</a>
            <a href="{{ url('/ratings-received') }}" class="collection-item active bg-primary">Avis reçus</a>
            <a href="{{ url('/ratings-given') }}" class="collection-item text-primary">Avis laissés</a>
        </div>
    </div>

    <div class="col m9 s12">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col l6">
                        <h3>Avis reçus en tant que conducteur</h3>

                         @forelse($conducteurs as $conducteur)
                            <div class="card">
                                <div class="card-content">
                                    <p>
                                        @if($conducteur->inscription_avis_conducteur == 5)
                                            <i class="material-icons green-text text-darken-2">mode_comment</i> Parfait !
                                        @elseif($conducteur->inscription_avis_conducteur == 4)
                                            <i class="material-icons light-green-text text-darken-1">mode_comment</i> Très bon !
                                        @elseif($conducteur->inscription_avis_conducteur == 3)
                                            <i class="material-icons lime-text text-darken-1">mode_comment</i> Bon !
                                        @elseif($conducteur->inscription_avis_conducteur == 2)
                                            <i class="material-icons orange-text text-darken-2">mode_comment</i> Mauvais !
                                        @elseif($conducteur->inscription_avis_conducteur == 1)
                                            <i class="material-icons red-text text-accent-4">mode_comment</i> Horrible !
                                        @endif
                                    </p>
                                    <a class="link" href="{{ url('profile/show/'.$conducteur->id) }}">{{ $conducteur->membre_prenom }} {{ $conducteur->name[0] }}</a><p> : &nbsp;{{ $conducteur->inscription_commentaire_conducteur }}</p>
                                    <p class="blue-grey-text text-lighten-2 date-trajet">{{ date('d/m/Y à H:i',strtotime($conducteur->inscription_date_commentaire_conducteur)) }}</p>
                                </div>
                            </div>
                        @empty
                             <div class="alert alert-info">Il n'y a pas encore d'avis en tant que conducteur</div>
                        @endforelse
                    </div>

                    <div class="col l6">
                        <h3>Avis reçus en tant que voyageur</h3>

                        @forelse($passagers as $passager)
                            <div class="card">
                                <div class="card-content">
                                    <p>
                                        @if($passager->inscription_avis_voyageur == 5)
                                            <i class="material-icons green-text text-darken-2">mode_comment</i> Parfait !
                                        @elseif($passager->inscription_avis_voyageur == 4)
                                            <i class="material-icons light-green-text text-darken-1">mode_comment</i> Très bon !
                                        @elseif($passager->inscription_avis_voyageur == 3)
                                            <i class="material-icons lime-text text-darken-1">mode_comment</i> Bon !
                                        @elseif($passager->inscription_avis_voyageur == 2)
                                            <i class="material-icons orange-text text-darken-2">mode_comment</i> Mauvais !
                                        @elseif($passager->inscription_avis_voyageur == 1)
                                            <i class="material-icons red-text text-accent-4">mode_comment</i> Horrible !
                                        @endif
                                    </p>
                                    <a class="link" href="{{ url('profile/show/'.$passager->id) }}">{{ $passager->membre_prenom }} {{ $passager->name[0] }}</a><p> : &nbsp;{{ $passager->inscription_commentaire_voyageur }}</p>
                                    <p class="blue-grey-text text-lighten-2 date-trajet">{{ date('d/m/Y à H:i',strtotime($passager->inscription_date_commentaire_voyageur)) }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">Il n'y a pas encore d'avis en tant que voyageur</div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
