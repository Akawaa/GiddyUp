@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Inscrivez-vous gratuitement !</h2>
    <p>Déjà inscrit ? <a href="{{ url('/login') }}" class="link">Connectez-vous ici</a></p>
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
                <i class="material-icons prefix">account_circle</i>
                <input type="text" id="surname" name="surname" value="{{ old('surname') }}" class="validate">
                <label for="surname">Prénom</label>
                @if ($errors->has('surname'))
                <span class="help-block">
                    <strong>{{ $errors->first('surname') }}</strong>
                </span>
                @endif
            </div>
            <div class="input-field col m6 s12">
                <i class="material-icons prefix">account_circle</i>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="validate">
                <label for="name">Nom</label>
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">today</i>
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
                <i class="material-icons prefix">phone</i>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="validate">
                <label for="phone">Téléphone</label>

                @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif
            </div>
            <div class="input-field col m6 s12">
                <i class="material-icons prefix">email</i>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="validate">
                <label for="email">Email</label>

                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="input-field col m6 s12">
                <i class="material-icons prefix">lock</i>
                <input type="password" id="password" name="password" class="validate">
                <label for="password">Mot de passe</label>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>

            <div class="input-field col m6 s12">
                <i class="material-icons prefix">lock</i>
                <input type="password" id="password_confirmation" name="password_confirmation" class="validate">
                <label for="password_confirmation">Confirmation du mot de passe</label>
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
