@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        <ul class="subonglet">
            <li class="onglet col m3 s12"><a href="{{ url('/home') }}">Tableau de bord</a></li>
            <li class="onglet col m3 s12"><a class="active" href="{{ url('/trip-offers/active') }}">Mes annonces</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/ratings') }}">Avis</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">Profil</a></li>
        </ul>
    </div>

    <div class="col m3 s12">
        <div class="collection">
            <a href="{{ url('/trip-offers/active') }}" class="collection-item active bg-primary">Trajets à venir</a>
            <a href="{{ url('/trip-offers/inactive') }}" class="collection-item text-primary">Trajets passés</a>
        </div>
    </div>

    <div class="col m9 s12">
        <div class="card">
            <div class="card-content">
                <h3>Mes annonces</h3>

                @if(Auth::user()->site_id == null)
                <div>Vous devez ajouter un site de formation avant de pouvoir créer une annonce !</div>
                @endif

                @if($nbVehicule == 0)
                <div>Vous devez <a href="{{ url('/profile/car/create') }}" class="link">ajouter un véhicule</a> avant de pouvoir créer une annonce !</div>
                @endif

                <div>
                    @forelse($trajets as $trajet)
                    <li>{{ $trajet->trajet_id }}}</li>
                    @empty
                    <p>Vous n'avez aucune annonce.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large waves-effect waves-light bg-primary"><i class="material-icons">add</i></a>
    </div>
</div>

@endsection
