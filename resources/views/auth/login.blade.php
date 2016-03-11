@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Connectez-vous</h3>
    <p>Pas encore inscrit ? <a href="{{ url('/register') }}" class="link">Inscrivez-vous ici</a></p>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        {!! csrf_field() !!}

        <div class="row {{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <input type="email" class="validate" name="email" value="{{ old('email') }}">
                <label>Email</label>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="row {{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="input-field col s12">
                <i class="material-icons prefix">lock</i>
                <input type="password" class="validate" name="password">
                <label>Mot de passe</label>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input type="checkbox" id="remember" class="filled-in"/>
                <label for="remember">Se souvenir de moi</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <button type="submit" class="btn btn-primary waves-effect waves-light">
                    <i class="fa fa-btn fa-sign-in"></i> Se connecter
                </button>
                <a class="btn btn-third waves-effect waves-light" href="{{ url('/password/reset') }}">Mot de passe oublié ?</a>
            </div>
        </div>
    </form>
</div>
@endsection
