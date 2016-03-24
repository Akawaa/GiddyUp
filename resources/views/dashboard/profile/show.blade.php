@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col m8 s12">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col m4">
                            @if($user->membre_photo!='' && $user->membre_photo_valide == 1)
                            <img src="{{ asset('img/uploads/'.$user->id.'/'.$user->membre_photo) }}" class="responsive-img circle photo_profil">
                            @endif
                        </div>
                        <div class="col m8">
                            <h3>{{ $user->membre_prenom }} {{ $user->name[0] }} <span class="light">({{ date('Y')-$user->membre_annee_naissance }} ans)</span></h3>
                            @if($noteConducteur != null || $notePassager != null)
                            <p>
                                Note globale : <i class="material-icons amber-text icon-valign">star</i> @if($noteConducteur == null)
                                {{ round($notePassager,1) }}
                                @elseif($notePassager == null)
                                {{ round($noteConducteur,1) }}
                                @else
                                {{ round(($noteConducteur+$notePassager)/2,1) }}
                                @endif
                            </p>
                            @endif
                            <p>
                                Expérience : @if($exp < 3)
                                Débutant
                                @elseif($exp >= 3 && $exp < 10)
                                Habitué
                                @elseif($exp >= 10 && $exp < 20)
                                Familier
                                @elseif($exp > 20)
                                Expérimenté
                                @endif
                            </p>
                            <div class="row">
                                <div class="col l2 s3">
                                    @if($user->membre_pref_dis != '')
                                    <img src="{{ asset('img/preferences/discussion'.$user->membre_pref_dis.'.png') }}">
                                    @endif
                                </div>
                                <div class="col l2 s3">
                                    @if($user->membre_pref_mus != '')
                                    <img src="{{ asset('img/preferences/musique'.$user->membre_pref_mus.'.png') }}">
                                    @endif
                                </div>
                                <div class="col l2 s3">
                                    @if($user->membre_pref_cig != '')
                                    <img src="{{ asset('img/preferences/cigarette'.$user->membre_pref_cig.'.png') }}">
                                    @endif
                                </div>
                                <div class="col l2 s3">
                                    @if($user->membre_pref_ani != '')
                                    <img src="{{ asset('img/preferences/animal'.$user->membre_pref_ani.'.png') }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="alert alert-info">
                        @if($user->membre_present != '')
                        {{ $user->membre_present }}
                        @else
                        Je n'ai pas encore rédigé ma présention.
                        @endif
                    </p>
                </div>
                <div class="card-action">
                    <h4>Avis en tant que conducteur</h4>
                    @if($avisConducteur !=null)
                    <p>
                        <i class="material-icons amber-text icon-valign">star</i>
                        {{ round($noteConducteur,1) }}
                    </p>
                    @endif

                    @forelse($avisConducteur as $avisConducteur)
                    <div class="card">
                        <div class="card-content">
                            <p>
                                @if($avisConducteur->inscription_avis_conducteur == 5)
                                <i class="material-icons green-text text-darken-2">mode_comment</i> Parfait !
                                @elseif($avisConducteur->inscription_avis_conducteur == 4)
                                <i class="material-icons light-green-text text-darken-1">mode_comment</i> Très bon !
                                @elseif($avisConducteur->inscription_avis_conducteur == 3)
                                <i class="material-icons lime-text text-darken-1">mode_comment</i> Bon !
                                @elseif($avisConducteur->inscription_avis_conducteur == 2)
                                <i class="material-icons orange-text text-darken-2">mode_comment</i> Mauvais !
                                @elseif($avisConducteur->inscription_avis_conducteur == 1)
                                <i class="material-icons red-text text-accent-4">mode_comment</i> Horrible !
                                @endif
                            </p>
                            <a class="link" href="{{ url('profile/show/'.$avisConducteur->id) }}">{{ $avisConducteur->membre_prenom }} {{ $avisConducteur->name[0] }}</a><p> : &nbsp;{{ $avisConducteur->inscription_commentaire_conducteur }}</p>
                            <p class="blue-grey-text text-lighten-2 date-trajet">{{ date('d/m/Y à H:i',strtotime($avisConducteur->inscription_date_commentaire_conducteur)) }}</p>
                        </div>
                    </div>
                    @empty
                    <p>Je n'ai pas encore d'avis en tant que conducteur.</p>
                    @endforelse
                </div>
                <div class="card-action">
                    <h4>Avis en tant que passager</h4>
                    @if($avisPassager !=null)
                    <p>
                        <i class="material-icons amber-text icon-valign">star</i>
                        {{ round($notePassager,1) }}
                    </p>
                    @endif
                    @forelse($avisPassager as $avisPassager)
                    <div class="card">
                        <div class="card-content">
                            <p>
                                @if($avisPassager->inscription_avis_voyageur == 5)
                                <i class="material-icons green-text text-darken-2">mode_comment</i> Parfait !
                                @elseif($avisPassager->inscription_avis_voyageur == 4)
                                <i class="material-icons light-green-text text-darken-1">mode_comment</i>  Très bon !
                                @elseif($avisPassager->inscription_avis_voyageur == 3)
                                <i class="material-icons lime-text text-darken-1">mode_comment</i> Bon !
                                @elseif($avisPassager->inscription_avis_voyageur == 2)
                                <i class="material-icons orange-text text-darken-2">mode_comment</i> Mauvais !
                                @elseif($avisPassager->inscription_avis_voyageur == 1)
                                <i class="material-icons red-text text-accent-4">mode_comment</i> Horrible !
                                @endif
                                {{ $avisPassager->membre_prenom }} {{ $avisPassager->name[0] }}
                            </p>
                            <a class="link" href="{{ url('profile/show/'.$avisPassager->id) }}">{{ $avisPassager->membre_prenom }} {{ $avisPassager->name[0] }}</a><p> : &nbsp;{{ $avisPassager->inscription_commentaire_conducteur }}</p>
                            <p class="blue-grey-text text-lighten-2 date-trajet">{{ date('d/m/Y à H:i',strtotime($avisPassager->inscription_date_commentaire_voyageur)) }}</p>
                        </div>
                    </div>
                    @empty
                    <p>Je n'ai pas encore d'avis en tant que passager.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col m4 s12">
            <div class="card">
                <div class="card-content">
                    <h4>Activité</h4>
                    <div class="row">
                        <p class="col m6 s12 blue-grey-text text-lighten-2">
                            Date d'inscription
                        </p>
                        <p class="col m6 s12">
                            {{ date('d F Y',strtotime($user->created_at)) }}
                        </p>
                        <p class="col m6 s12 blue-grey-text text-lighten-2">
                            Annonces publiées
                        </p>
                        <p class="col m6 s12">
                            {{ $nbTrajets }}
                        </p>
                    </div>
                </div>
                <div class="card-action">
                    <h4>Véhicules</h4>
                    @forelse($vehicules as $vehicule)
                    <div class="card card-giddy">
                        <div class="card-content">
                            <p>{{ $vehicule->modele->marque->type->type_libelle }}</p>
                            <p>{{ $vehicule->modele->marque->marque_libelle }} - {{ $vehicule->modele->modele_libelle }}</p>
                            <p>Confort : {{ $vehicule->vehicule_confort }} <i class="material-icons icon-valign">stars</i></p>
                            <p>Couleur : {{ $vehicule->couleur->couleur_libelle }}</p>
                        </div>
                    </div>
                    @empty
                    <p>{{ $user->membre_prenom }} n'a pas encore de véhicule.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection