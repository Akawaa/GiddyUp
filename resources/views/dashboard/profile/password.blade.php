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
            <a href="{{ url('/profile/email/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer d'adresse email</a>
            <a href="{{ url('/profile/password/'.Auth::user()->id.'/edit') }}" class="collection-item active bg-primary">Changer de mot de passe</a>            </div>
        </div>

        <div class="col m9 s12">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <h3>Changer de mot de passe</h3>
                            @if (session('status'))
                            <div>
                                {{ session('status') }}
                            </div>
                            @endif

                            {{Form::model($user,array('route' => array('profile.password.update',$user->id),'method'=>'PUT')) }}
                            <div class="row">
                                <div class="input-field col m6 s12">
                                    <i class="material-icons prefix">lock</i>
                                    {{ Form::password('password',array('class'=>'validate') ) }}
                                    {{ Form::label('password','Mot de passe',array('class'=>'active')) }}

                                    @if ($errors->first('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                                </div>

                                <div class="input-field col m6 s12">
                                    <i class="material-icons prefix">lock</i>
                                    {{ Form::password('password_confirmation',array('class'=>'validate') ) }}
                                    {{ Form::label('password_confirmation','Confirmation du mot de passe',array('class'=>'active')) }}

                                    @if ($errors->first('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
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
        </div>
    </div>
</div>

@endsection

@section('script')

$('select').material_select();

@endsection
