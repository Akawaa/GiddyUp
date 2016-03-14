@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        <ul class="subonglet">
            <li class="onglet col s3"><a href="{{ url('/home') }}">Tableau de bord</a></li>
            <li class="onglet col s3"><a href="{{ url('/trip-offers') }}">Mes annonces</a></li>
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
            <a href="{{ url('/profile/car') }}" class="collection-item text-primary">Véhicule</a>
            <a href="{{ url('/profile/email/'.Auth::user()->id.'/edit') }}" class="collection-item active bg-primary">Changer d'adresse email</a>
            <a href="{{ url('/profile/password/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer de mot de passe</a>
        </div>
    </div>

    <div class="col m9 s12">
        <div class="card">
            <div class="card-content">
                <h3>Changer d'adresse mail</h3>
                @if (session('status'))
                <div>
                    {{ session('status') }}
                </div>
                @endif

                <p class="alert alert-warning">Attention, votre adresse email vous permet de vous connecter.</p>
                {{Form::model($user,array('route' => array('profile.email.update',$user->id),'method'=>'PUT')) }}
                <div class="row">
                    <div class="input-field col s12 l6">
                        <i class="material-icons prefix">email</i>
                        {{ Form::email('email',$user->email,array('class'=>'validate') ) }}
                        {{ Form::label('email','Email',array('class'=>'active')) }}

                        @if ($errors->first('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif

                    </div>
                </div>
                <div class="row">
                    {{ Form::button('Mettre à jour',['class'=>'waves-effect waves-light btn btn-primary','type'=>'submit']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endsection