@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <ul class="subonglet">
                <li class="onglet col s3"><a class="active" href="{{ url('/home') }}">Tableau de bord</a></li>
                <li class="onglet col s3"><a href="{{ url('/trip-offers/active') }}">Mes annonces</a></li>
                <li class="onglet col s3"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
                <li class="onglet col s3"><a href="{{ url('/ratings') }}">Avis</a></li>
                <li class="onglet col s3"><a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">Profil</a></li>
            </ul>
        </div>
    </div>

    <div class="row">

        <div class="col s12">

            <h4>Tableau de bord</h4>

        </div>

        <div class="row">
            <div class="col s3">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s6">
                                @if(Auth::user()->membre_photo == null)
                                    <i class="material-icons large">add_a_photo</i>
                                @else
                                    <img class="responsive-img circle photo_profil" src="{{ asset('profile_picture/'.Auth::user()->id.'/'.Auth::user()->membre_photo) }}" alt="">
                                @endif
                            </div>

                                <div class="col s6">
                                    <p>Bonjour {{ Auth::user()->membre_prenom }} !</p>

                                    <a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">Modifier votre profil</a>
                                    <br>
                                    <a href="{{ url('/profil/membre/'.Auth::user()->id) }}">Voir votre profil</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s9">
                <div class="card">
                    <div class="card-content">
                       <p>Avis en attente !</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s5">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                                    <p>Nouvelle demande !</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s7">
                <div class="card">
                    <div class="card-content">
                        <p>Nouvelle(s) Question(s)</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <p>Niveau d'experience</p>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
