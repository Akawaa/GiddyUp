@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <ul class="subonglet">
                <li class="onglet col s3"><a href="{{ url('/home') }}">Tableau de bord</a></li>
                <li class="onglet col s3"><a href="{{ url('/trip-offers') }}">Mes annonces</a></li>
                <li class="onglet col s3"><a class="active" href="{{ url('/bookings') }}">Mes réservations</a></li>
                <li class="onglet col s3"><a href="{{ url('/ratings') }}">Avis</a></li>
                <li class="onglet col s3"><a href="{{ url('/profile') }}">Profil</a></li>
            </ul>
        </div>


        <div class="col s12">

            <h4>Mes réservations</h4>

        </div>

@endsection
