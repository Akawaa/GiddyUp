@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <h2>Mot de passe oublié</h2>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <form role="form" method="POST" action="{{ url('/password/email') }}">
            {!! csrf_field() !!}
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <input type="email" class="validate" name="email">
                    <label for="email">Adresse E-Mail</label>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Renouveler mon mot de passe
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
