@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        <ul class="subonglet">
            <li class="onglet col s3"><a class="active" href="{{ url('/home') }}">Tableau de bord</a></li>
            <li class="onglet col s3"><a href="{{ url('/trip-offers/active') }}">Mes annonces</a></li>
            <li class="onglet col s3"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
            <li class="onglet col s3"><a href="{{ url('/ratings') }}">Avis</a></li>
            <li class="onglet col s3"><a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">profil</a></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col l3 m5 s12">
        <div class="card bg-third banderole">
            <div class="card-content">
                <div class="row">
                    <div class="col s5">
                        @if(Auth::user()->membre_photo == null)
                        <i class="material-icons large">account_circle</i>
                        @else
                        <img class="responsive-img circle photo_profil" src="{{ asset('profile_picture/'.Auth::user()->id.'/'.Auth::user()->membre_photo) }}" alt="">
                        @endif
                    </div>

                    <div class="col s7">
                        <h4>Bonjour {{ Auth::user()->membre_prenom }}!</h4>
                        <a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">Modifier votre profil</a>
                        <br>
                        <a href="{{ url('/profil/membre/'.Auth::user()->id) }}">Voir votre profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col l9 m7 s12">
        <div class="card card-secondary">
            <div class="card-content">
             <h4>Avis en attente !</h4>
         </div>
     </div>
 </div>
</div>

<div class="row">
    <div class="col m5 s12">
        <div class="card card-secondary">
            <div class="card-content">
                <div class="row">
                    <h4>Nouvelle demande !</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col m7 s12">
        <div class="card card-secondary">
            <div class="card-content">
                <h4>Nouvelle(s) Question(s)</h4>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <div class="card card-green">
            <div class="card-content">
                <h4 class="xp-heading">Niveau d'experience</h4>
                <div class="row">
                    <div class="col s3">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
