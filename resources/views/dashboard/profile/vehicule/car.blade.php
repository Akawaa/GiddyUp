@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        <ul class="subonglet">
            <li class="onglet col s3"><a href="{{ url('/home') }}">Tableau de bord</a></li>
            <li class="onglet col s3"><a href="{{ url('/trip-offers/active') }}">Mes annonces</a></li>
            <li class="onglet col s3"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
            <li class="onglet col s3"><a href="{{ url('/ratings') }}">Avis</a></li>
            <li class="onglet col s3"><a class="active" href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">Profil</a></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col m3 s12">
        <div class="collection">
            <a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Informations personnelles</a>
            <a href="{{ url('/profile/university/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Université</a>
            <a href="{{ url('/profile/picture/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Photo</a>
            <a href="{{ url('/profile/preferences/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Préférence</a>
            <a href="{{ url('/profile/car') }}" class="collection-item bg-primary active">Véhicule</a>
            <a href="{{ url('/profile/email/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer d'adresse email</a>
            <a href="{{ url('/profile/password/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer de mot de passe</a>            </div>
        </div>

        <div class="col m9 s12">
            <div class="card">
                <div class="card-content">
                    <h3>Véhicule</h3>
                    @if (session('status'))
                    <div>
                        {{ session('status') }}
                    </div>
                    @endif

                    @forelse($vehicules as $vehicule)

                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s3">
                                            <div class="row">
                                                <div class="col s12">
                                                    @if($vehicule->type_id == 1)
                                                    <i class="material-icons large">directions_car</i>
                                                    @else
                                                    <i class="material-icons large">motorcycle</i>
                                                    @endif
                                                </div>

                                                <div class="col s12">
                                                    <a href="#">Ajouter une photo</a>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col s9">
                                            <p class="card-title">{{ $vehicule->marque_libelle }} - {{ $vehicule->modele_libelle }}</p>
                                            <p>{{ $vehicule->vehicule_place }} places - {{ $vehicule->vehicule_confort }}</p>
                                            <p>
                                                <a href="{{ url('profile/car/'.$vehicule->vehicule_id.'/edit') }}" class="waves-effect waves-light btn amber"> Modifier</a>

                                                {{ Form::open(array('url'=> 'profile/car/'.$vehicule->vehicule_id)) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                {{ Form::button('Supprimer', ['class' => 'waves-effect waves-light btn amber','type'=>'submit']) }}
                                                {{ Form::close() }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <p>Vous n'avez aucun véhicule.</p>
                    @endforelse
                    <a href="{{ url('profile/car/create') }}" class="waves-effect waves-light btn btn-primary"><i class="material-icons left">directions_car</i>Ajouter</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

$('select').material_select();

@endsection
