@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Rechercher un trajet</h2>
    <form class="row" method="post" action="">
        <div class="row">
            <div class="input-field col s12">
                <i class="fa fa-location-arrow prefix"></i>
                <input id="icon_prefix" type="text" class="validate">
                <label for="icon_prefix2">Départ</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <i class="fa fa-flag-checkered prefix"></i>
                <input id="icon_prefix" type="text" class="validate">
                <label for="icon_prefix2">Arrivée</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <i class="fa fa-calendar-check-o prefix"></i>
                <input type="date" class="datepicker">
                <label for="icon_prefix2">Date</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field">
                <button class="btn waves-effect waves-light btn-primary col s12" type="submit" name="action">Rechercher <i class="material-icons prefix">search</i></button>
            </div>
        </div>
    </form>
</div>
@endsection