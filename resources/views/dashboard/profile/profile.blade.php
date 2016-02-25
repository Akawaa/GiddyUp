@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <ul class="subonglet">
                <li class="onglet col s3"><a href="{{ url('/home') }}">Tableau de bord</a></li>
                <li class="onglet col s3"><a href="{{ url('/trip-offers/active') }}">Mes annonces</a></li>
                <li class="onglet col s3"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
                <li class="onglet col s3"><a href="{{ url('/ratings') }}">Avis</a></li>
                <li class="onglet col s3"><a class="active" href="{{ url('/profile') }}">Profil</a></li>
            </ul>
        </div>

        <div class="col s3">
            <div class="collection">
                <a href="{{ url('/profile') }}" class="collection-item active red darken-3">Informations personnelles</a>
                <a href="{{ url('/profile/universite') }}" class="collection-item red-text text-darken-3">Université</a>
                <a href="{{ url('/profile') }}" class="collection-item red-text text-darken-3">Photo</a>
                <a href="{{ url('/profile') }}" class="collection-item red-text text-darken-3">Préférence</a>
                <a href="{{ url('/profile') }}" class="collection-item red-text text-darken-3">Véhicule</a>
                <a href="{{ url('/profile') }}" class="collection-item red-text text-darken-3">Changer de mot de passe</a>
            </div>
        </div>

        <div class="col s9">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <h5>Informations Personnelles</h5>

                            <form>

                                <div class="row">
                                    <div class="input-field col s6">
                                        @if(Auth::user()->membre_sexe == 'h')
                                            <input disabled value="M" id="disabled" type="text" class="validate">
                                        @else
                                            <input disabled value="Mme" id="disabled" type="text" class="validate">
                                        @endif
                                            <label class="active" for="disabled">Civilité</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                        <input value="{{ Auth::user()->membre_prenom }}" id="first_name2" type="text" class="validate">
                                        <label class="active" for="first_name2">Prénom</label>
                                    </div>

                                    <div class="input-field col s6">
                                        <input value="{{ Auth::user()->name }}" id="first_name2" type="text" class="validate">
                                        <label class="active" for="first_name2">Nom</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                        <input value="{{ Auth::user()->email }}" id="email" type="email" class="validate">
                                        <label class="active" for="email">Email</label>
                                    </div>

                                    <div class="input-field col s6">
                                        <input value="{{ Auth::user()->membre_telephone }}" id="phone" type="text" class="validate">
                                        <label class="active" for="phone">Téléphone</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                    <select name="year">
                                        <option value="" disabled selected>Année de naissance</option>
                                        @for($i=intval(date('Y')-18);$i>intval(date('Y')-101);$i--)
                                            <option class="red-text text-darken-4" value="{{$i}}" @if($i == Auth::user()->membre_annee_naissance)<?php echo "selected"?>@endif >{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                        <textarea id="presentation" class="materialize-textarea" length="255" placeholder="Ex. : 'Je suis étudiant à Gap et je vais souvent rendre visite à ma famille sur Marseille. J'aime l'informatique et suis passionné de musique."></textarea>
                                        <label for="presentation">Textarea</label>
                                    </div>

                                    <div class="col s6">
                                        <p>Ne pas indiquer :</p>
                                        <ul>
                                            <li><i class="material-icons">close</i> Numéro de téléphone</li>
                                            <li><i class="material-icons">close</i> Détails sur votre compte Facebook</li>
                                            <li><i class="material-icons">close</i> Détails sur des trajats en particulier</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="row">
                                    <div>
                                        <button type="submit" class="waves-effect waves-light btn red darken-4">
                                            Mettre à jour
                                        </button>
                                    </div>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('script')

    $('select').material_select();

@endsection
