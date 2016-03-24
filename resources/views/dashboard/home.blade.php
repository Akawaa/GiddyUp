@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        <ul class="subonglet">
            <li class="onglet col s3"><a class="active" href="{{ url('/home') }}">Tableau de bord</a></li>
            <li class="onglet col s3"><a href="{{ url('/trip-offers') }}">Mes annonces</a></li>
            <li class="onglet col s3"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
            <li class="onglet col s3"><a href="{{ url('/ratings') }}">Avis</a></li>
            <li class="onglet col s3"><a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">profil</a></li>
        </ul>
    </div>
</div>
<div class="card">
    <div class="card-content">
        <h2>Tableau de bord</h2>
        <div class="row">
            <div class="col l3 m6 s12">
                <div class="card bg-third banderole">
                    <div class="card-content">
                        <div class="row valign-wrapper">
                            <div class="col m6 s12">
                                @if(Auth::user()->membre_photo == null)
                                <i class="material-icons large">acount_circle</i>
                                @else
                                <img class="responsive-img circle photo_profil" src="{{ asset('img/uploads/'.Auth::user()->id.'/'.Auth::user()->membre_photo) }}" alt="">
                                @endif
                            </div>

                            <div class="col m6 s12">
                                <h4>Bonjour {{ Auth::user()->membre_prenom }} !</h4>
                                <a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}" class="link">Modifier votre profil</a>
                                <br>
                                <a href="{{ url('/profile/show/'.Auth::user()->id) }}" class="link">Voir votre profil</a>
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
                    <div class="row">
                        <div class="col l4">
                            {{ count($questions) }}
                            Nouvelle(s) question(s)
                        </div>

                        <div class="col l8">
                            @forelse($questions as $question)
                                <div class="row">
                                    <div class="col l4">

                                        <p>{{ $question->membre_prenom }} {{ $question->name[0]}}</p>
                                    </div>
                                    <div class="col l8">
                                        <p>Nouvelle question pour {{ $question->depart }} -> {{ $question->arrivee }}</>

                                        <p>{{ $question->question_libelle }}</p>
                                    </div>
                                </div>
                            @empty
                                Vous n'avez actuellement pas de question.
                            @endforelse


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="card card-green card-xp">
                <div class="card-content">
                    <h4 class="xp-heading">Niveau d'experience</h4>
                    <div class="row">   
                        <div class="col s1 offset-s2">
                            <p class="center-align">Débutant</p>
                        </div>
                        <div class="col s1 offset-s1">
                            <p class="center-align">Habitué</p>
                        </div>
                        <div class="col s1 offset-s1">
                            <p class="center-align"><strong>Familier</strong></p>
                        </div>
                        <div class="col s1 offset-s1">
                            <p class="center-align">Expert</p>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="col s1 offset-s2">
                            <div class="circle white"><i class="material-icons">check_circle</i></div>
                        </div>
                        <div class="col s1">
                            <i class="material-icons">keyboard_arrow_right</i>
                        </div>
                        <div class="col s1">
                            <div class="circle white">
                                @if($exp >= 3)
                                    <i class="material-icons">check_circle</i>
                                @endif
                            </div>
                        </div>
                        <div class="col s1">
                            <i class="material-icons">keyboard_arrow_right</i>
                        </div>
                        <div class="col s1">
                            <div class="circle white">
                                @if($exp >= 10)
                                    <i class="material-icons">check_circle</i>
                                @endif
                            </div>
                        </div>
                        <div class="col s1">
                            <i class="material-icons">keyboard_arrow_right</i>
                        </div>
                        <div class="col s1">
                                <div class="circle white">
                                    @if($exp >= 20)
                                        <i class="material-icons">check_circle</i>
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
