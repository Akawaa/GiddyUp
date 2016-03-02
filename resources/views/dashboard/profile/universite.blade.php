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
    </div>

    <div class="row">
        <div class="col s3">
            <div class="collection">
                <a href="{{ url('/profile') }}" class="collection-item red-text text-darken-3">Informations personnelles</a>
                <a href="{{ url('/profile/university') }}" class="collection-item active red darken-3">Université</a>
                <a href="{{ url('/profile/picture') }}" class="collection-item red-text text-darken-3">Photo</a>
                <a href="{{ url('/profile') }}" class="collection-item red-text text-darken-3">Préférences</a>
                <a href="{{ url('/profile') }}" class="collection-item red-text text-darken-3">Véhicule</a>
                <a href="{{ url('/profile') }}" class="collection-item red-text text-darken-3">Changer de mot de passe</a>
            </div>
        </div>

        <div class="col s9">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <h5>Université</h5>

                            <form>

                                <div class="row">
                                    <div class="input-field col s6">
                                        <select name="universite" class="icons">
                                            <option value="" disabled selected>Universite</option>
                                            @foreach($universites as $universite)
                                                <option class="red-text text-darken-4" data-icon="{{asset('img/universite_logo/'.$universite->universite_logo)}}" value="{{$universite->universite_id}}">{{$universite->universite_nom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                        <select name="site">
                                            <option value="" disabled selected>Site</option>
                                            @foreach($sites as $site)
                                                <option class="red-text text-darken-4" value="{{$site->site_id}}">{{$site->site_nom}}</option>
                                            @endforeach
                                        </select>
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
