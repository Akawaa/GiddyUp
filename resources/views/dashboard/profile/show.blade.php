@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col l4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Activité</span>
                        <div class="row">
                            <div class="col l6 blue-grey-text text-lighten-2">
                                Date d'inscription
                            </div>
                            <div class="col l6">
                                {{ date('d F Y',strtotime($user->created_at)) }}
                            </div>
                            <div class="col l6 blue-grey-text text-lighten-2">
                                Annonces publiées
                            </div>
                            <div class="col l6">
                                {{ $nbTrajets }}
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <span class="card-title">Véhicules</span>

                        @forelse($vehicules as $vehicule)
                            <div class="card">
                                <div class="card-content">
                                    <p>{{ $vehicule->modele->marque->type->type_libelle }}</p>
                                    <p>{{ $vehicule->modele->marque->marque_libelle }} - {{ $vehicule->modele->modele_libelle }}</p>
                                    <p>Confort : {{ $vehicule->vehicule_confort }} <i class="material-icons">stars</i></p>
                                    <p>Couleur : {{ $vehicule->couleur->couleur_libelle }}</p>

                                </div>
                            </div>
                        @empty
                            {{ $user->membre_prenom }} n'a pas encore de véhicule.
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col l8">
                <div class="card">
                    <div class="card-content">
                            <div class="row">
                                <div class="col l2">
                                    @if($user->membre_photo!='' && $user->membre_photo_valide == 1)
                                        <img src="{{ asset('img/uploads/'.$user->id.'/'.$user->membre_photo) }}" class="responsive-img circle">
                                    @endif
                                </div>

                                <div class="col l10">
                                    <span class="card-title">{{ $user->membre_prenom }} {{ $user->name[0] }} ({{ date('Y')-$user->membre_annee_naissance }} ans)</span>

                                    @if($noteConducteur != null || $notePassager != null)
                                        <p>Note globale : <i class="material-icons amber-text icon-valign">star</i> @if($noteConducteur == null)
                                                              {{ round($notePassager,1) }}
                                                          @elseif($notePassager == null)
                                                              {{ round($noteConducteur,1) }}
                                                          @else
                                                            {{ round(($noteConducteur+$notePassager)/2,1) }}
                                                          @endif </p>
                                    @endif

                                    <p>Expérience : @if($exp < 3)
                                            Débutant
                                        @elseif($exp >= 3 && $exp < 10)
                                            Habitué
                                        @elseif($exp >= 10 && $exp<20)
                                            Familier
                                        @elseif($exp > 20)
                                            Expérimenté
                                        @endif</p>

                                    <div class="row">
                                        <div class="col s1">
                                            @if($user->membre_pref_dis != '')
                                                @if($user->membre_pref_dis == 1)
                                                    <img src="{{ asset('img/preferences/discussion1.png') }}" class="responsive-img">
                                                @elseif($user->membre_pref_dis == 2)
                                                    <img src="{{ asset('img/preferences/discussion2.png') }}" class="responsive-img">
                                                @else
                                                    <img src="{{ asset('img/preferences/discussion3.png') }}" class="responsive-img">
                                                @endif
                                            @endif
                                        </div>
                                        <div class="col s1">
                                            @if($user->membre_pref_mus != '')
                                                @if($user->membre_pref_mus == 1)
                                                    <img src="{{ asset('img/preferences/musique1.png') }}" class="responsive-img">
                                                @elseif($user->membre_pref_mus == 2)
                                                    <img src="{{ asset('img/preferences/musique2.png') }}" class="responsive-img">
                                                @else
                                                    <img src="{{ asset('img/preferences/musique3.png') }}" class="responsive-img">
                                                @endif
                                            @endif
                                        </div>
                                        <div class="col s1">
                                            @if($user->membre_pref_cig != '')
                                                @if($user->membre_pref_cig == 1)
                                                    <img src="{{ asset('img/preferences/cigarette1.png') }}" class="responsive-img">
                                                @elseif($user->membre_pref_cig == 2)
                                                    <img src="{{ asset('img/preferences/cigarette2.png') }}" class="responsive-img">
                                                @else
                                                    <img src="{{ asset('img/preferences/cigarette3.png') }}" class="responsive-img">
                                                @endif
                                            @endif
                                        </div>
                                        <div class="col s1">
                                            @if($user->membre_pref_ani != '')
                                                @if($user->membre_pref_ani == 1)
                                                    <img src="{{ asset('img/preferences/animal1.png') }}" class="responsive-img">
                                                @elseif($user->membre_pref_ani == 2)
                                                    <img src="{{ asset('img/preferences/animal2.png') }}" class="responsive-img">
                                                @else
                                                    <img src="{{ asset('img/preferences/animal3.png') }}" class="responsive-img">
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col l12">
                                    <div class="card">
                                        <div class="card-content">
                                            <span class="card-title">@if($user->membre_present != '')
                                                    {{ $user->membre_present }}
                                                @else
                                                    Je n'ai pas encore rédigé ma présention.
                                                @endif </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                        <div class="card-action">
                            <span class="card-title">Avis en tant que conducteur @if($avisConducteur !=null)<i class="material-icons amber-text icon-valign">star</i>{{ round($noteConducteur,1) }}</span>@endif

                            @forelse($avisConducteur as $avisConducteur)
                                <div class="card">
                                    <div class="card-content">
                                        <p>@if($avisConducteur->inscription_avis_conducteur == 5)
                                                <i class="material-icons green-text text-darken-2">mode_comment</i> Parfait !
                                            @elseif($avisConducteur->inscription_avis_conducteur == 4)
                                                <i class="material-icons light-green-text text-darken-1">mode_comment</i> Très bon !
                                            @elseif($avisConducteur->inscription_avis_conducteur == 3)
                                                <i class="material-icons lime-text text-darken-1">mode_comment</i> Bon !
                                            @elseif($avisConducteur->inscription_avis_conducteur == 2)
                                                <i class="material-icons orange-text text-darken-2">mode_comment</i> Mauvais !
                                            @elseif($avisConducteur->inscription_avis_conducteur == 1)
                                                <i class="material-icons red-text text-accent-4">mode_comment</i> Horrible !
                                            @endif</p>
                                        <p><a class="link" href="{{ url('profile/'.$avisConducteur->id) }}">{{ $avisConducteur->membre_prenom }} {{ $avisConducteur->name[0] }}</a> : &nbsp;{{ $avisConducteur->inscription_commentaire_conducteur }}</p>
                                        <p class="blue-grey-text text-lighten-2 date-trajet">{{ date('d/m/Y à H:i',strtotime($avisConducteur->inscription_date_commentaire_conducteur)) }}</p>
                                    </div>
                                </div>
                            @empty
                                <p>Je n'ai pas encore d'avis en tant que conducteur.</p>
                            @endforelse
                        </div>
                    <div class="card-action">
                        <span class="card-title">Avis en tant que passager @if($avisPassager !=null)<i class="material-icons amber-text icon-valign">star</i>{{ round($notePassager,1) }}</span>@endif

                        @forelse($avisPassager as $avisPassager)
                            <div class="card">
                                <div class="card-content">
                                    <p>@if($avisPassager->inscription_avis_voyageur == 5)
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
                                        {{ $avisPassager->membre_prenom }} {{ $avisPassager->name[0] }}</p>
                                    <p>{{ $avisPassager->inscription_commentaire_voyageur }}</p>
                                    <p class="blue-grey-text text-lighten-2 date-trajet">{{ date('d/m/Y à H:i',strtotime($avisPassager->inscription_date_commentaire_voyageur)) }}</p>


                                </div>
                            </div>
                        @empty
                            <p>Je n'ai pas encore d'avis en tant que passager.</p>
                        @endforelse
                    </div>


            </div>
        </div>
    </div>
@endsection