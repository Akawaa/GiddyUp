@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Inscrivez-vous gratuitement !</h2>
    <p>Déjà inscrit ? <a href="{{ url('/login') }}">Connectez-vous ici</a></p>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
        {!! csrf_field() !!}

        <div class="row">
            <div class="col">
                <input class="with-gap" name="genre" type="radio" id="homme" value="h" />
                <label for="homme">Homme</label>
            </div>
            <div class="col">
                <input class="with-gap" name="genre" type="radio" id="femme" value="f"/>
                <label for="femme">Femme</label>
            </div>
            @if ($errors->has('genre'))
            <span class="help-block">
                <strong>{{ $errors->first('genre') }}</strong>
            </span>
            @endif
        </div>

        <div class="row">
            <div class="input-field col m6 s12">
                <i class="fa fa-user prefix"></i>
                <input type="text" name="surname" value="{{ old('surname') }}" class="validate">
                <label>Prénom</label>
                @if ($errors->has('surname'))
                <span class="help-block">
                    <strong>{{ $errors->first('surname') }}</strong>
                </span>
                @endif
            </div>
            <div class="input-field col m6 s12">
                <input type="text" name="name" value="{{ old('name') }}" class="validate">
                <label>Nom</label>
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <i class="fa fa-calendar prefix"></i>
                <select name="year" class="validate">
                    <option disabled selected>Année de naissance</option>
                    @for($i=intval(date('Y')-18);$i>intval(date('Y')-101);$i--)
                    <option class="red-text text-darken-4" value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>

                @if ($errors->has('year'))
                <span class="help-block">
                    <strong>{{ $errors->first('year') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="input-field col m6 s12">
                <i class="fa fa-phone prefix"></i>
                <input type="text" name="phone" value="{{ old('phone') }}" class="validate">
                <label>Téléphone</label>

                @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif
            </div>
            <div class="input-field col m6 s12">
                <i class="fa fa-envelope prefix"></i>
                <input type="email" name="email" value="{{ old('email') }}" class="validate">
                <label>Email</label>

                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="input-field col m6 s12">
                <i class="fa fa-lock prefix"></i>
                <input type="password" name="password" class="validate">
                <label>Mot de passe</label>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>

            <div class="input-field col m6 s12">
                <input type="password" name="password_confirmation" class="validate">
                <label>Confirmation du mot de passe</label>
                @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="row">
            <button type="submit" class="waves-effect waves-light btn btn-primary col s12">
                S'inscrire
            </button>
        </div>
    </form>
</div>
@endsection

@section('script')

$('select').material_select();

@endsection
