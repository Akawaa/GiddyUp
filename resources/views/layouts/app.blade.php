<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="_token" content="{!! csrf_token() !!}"/>

    <title>GiddyUp</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,400italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

</head>
<body id="app-layout">
    <nav>
        <div class="nav-wrapper">
            <a href="{{ url('/') }}" class="logo"><img src="{{ asset('/img/logo_giddyup.png') }}" width="200px" alt="GiddyUP - Le covoiturage entre universités"></a>

            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons black">menu</i></a>
            <ul class="hide-on-med-and-down">
                <li class="s6"><a class="waves-effect waves-light btn btn-primary" href="{{ url('/search') }}">Rechercher</a></li>
                <li class="s6"><a class="waves-effect waves-light btn btn-secondary" href="{{ url('/trip-offers/create') }}">Proposer</a></li>
            </ul>
            <ul class="login-menu right hide-on-med-and-down">
                @if (Auth::guest())
                <li><a href="{{ url('/register') }}">S'inscrire</a></li>
                <li><a href="{{ url('/login') }}">Se connecter</a></li>
                @else
                <li><a class="dropdown-button" href="#!" data-activates="menu">{{ Auth::user()->membre_prenom}} {{ Auth::user()->name }} <i class="fa fa-caret-down"></i></a></li>

                    <ul id='menu' class='dropdown-content'>
                        <li><a href="{{ url('/home') }}">Tableau de bord</a></li>
                        <li><a href="{{ url('/trip-offers') }}">Mes annonces</a></li>
                        <li><a href="{{ url('/bookings') }}">Mes réservations</a></li>
                        <li><a href="{{ url('/ratings') }}">Avis</a></li>
                        <li><a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">Profil</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/logout') }}">Se déconnecter</a></li>
                    </ul>
                @endif
            </ul>

            
            <ul class="side-nav" id="mobile-demo">
                <li><a href="{{ url('/register') }}">S'inscrire</a></li>
                <li><a href="{{ url('/login') }}">Se connecter</a></li>

                <li><a class="waves-effect waves-light btn" href="{{ url('/search') }}">Rechercher</a></li>
                <li><a class="waves-effect waves-light btn" href="{{ url('/trip-offers/create') }}">Proposer</a></li>
            </ul>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
    <div class="bandeau_footer"></div>
    <footer>
        <div class="widget_footer bg-green col m3 s12 center-align">
            <h3>Infos Pratiques</h3>
            <ul class="left-align">
                <li><a href="#">Comment ça marche ?</a></li>
                <li><a href="#">Prix des covoiturages</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">F.A.Q</a></li>
                <li><a href="#">Conditions Générales</a></li>
            </ul>
        </div>
        <div class="widget_footer bg-secondary col m3 s12 center-align">
            <h3>Téléchargez l'appli !</h3>
            <div class="row">
                <img src="{{ asset('/img/appstore-logo.png') }}">
            </div>
            <div class="row">
                <img src="{{ asset('/img/playstore-logo.png') }}">
            </div>
        </div>
        <div class="widget_footer bg-primary col m3 s12 center-align">
            <h3>Infos Pratiques</h3>
            <ul class="left-align">
                <li><a href="#">Comment ça marche ?</a></li>
                <li><a href="#">Prix des covoiturages</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">F.A.Q</a></li>
                <li><a href="#">Conditions Générales</a></li>
            </ul>
        </div>
    </footer>
    <!-- JavaScripts -->
    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/materialize.js') }}"></script>

    @yield('map')

    @yield('depart')

    @yield('arrivee')

    <script type="text/javascript">

    $( document ).ready(function(){

        $(".button-collapse").sideNav();

        $(".dropdown-button").dropdown();

        @yield('script')

    });



    $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 5,// Creates a dropdown of 15 years to control year
            min: true
        });

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

    </script>

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
