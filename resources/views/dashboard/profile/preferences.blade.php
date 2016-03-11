@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        <ul class="subonglet">
            <li class="onglet col s3"><a href="{{ url('/home') }}">Tableau de bord</a></li>
            <li class="onglet col s3"><a href="{{ url('/trip-offers/active') }}">Mes annonces</a></li>
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
            <a href="{{ url('/profile/preferences/'.Auth::user()->id.'/edit') }}" class="collection-item active bg-primary">Préférences</a>
            <a href="{{ url('/profile/car') }}" class="collection-item text-primary">Véhicule</a>
            <a href="{{ url('/profile/email/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer d'adresse email</a>
            <a href="{{ url('/profile/password/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer de mot de passe</a>            </div>
        </div>

        <div class="col m9 s12">
            <div class="card">
                <div class="card-content">
                    <h3>Préférences</h3>
                    @if (session('status'))
                    <div>
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ Form::model($user, array('route' => array('profile.preferences.update',$user->id),'method'=>'PUT')) }}

                    <div class="row">
                        <div class="input-field col s12">
                            <span>Discussion</span>

                            <input name="discussion" type="radio" id="discussion1" value="1" @if($user->membre_pref_dis == 1) checked @endif/>
                            <label for="discussion1">discute peu</label>

                            <input name="discussion" type="radio" id="discussion2" value="2" @if($user->membre_pref_dis == 2) checked @endif/>
                            <label for="discussion2">discute selon l'humeur</label>

                            <input name="discussion" type="radio" id="discussion3" value="3" @if($user->membre_pref_dis == 3) checked @endif/>
                            <label for="discussion3">aime discuter</label>

                            @if ($errors->first('discussion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('discussion') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <span>Musique</span>

                            <input name="musique" type="radio" id="musique1" value="1" @if($user->membre_pref_mus == 1) checked @endif/>
                            <label for="musique1"> jamais</label>

                            <input name="musique" type="radio" id="musique2" value="2" @if($user->membre_pref_mus == 2) checked @endif/>
                            <label for="musique2"> parfois</label>

                            <input name="musique" type="radio" id="musique3" value="3" @if($user->membre_pref_mus == 3) checked @endif/>
                            <label for="musique3"> toujours</label>

                            @if ($errors->first('musique'))
                            <span class="help-block">
                                <strong>{{ $errors->first('musique') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <span>Cigarette</span>

                            <input name="cig" type="radio" id="cig1" value="1" @if($user->membre_pref_cig == 1) checked @endif/>
                            <label for="cig1"> jamais</label>

                            <input name="cig" type="radio" id="cig2" value="2" @if($user->membre_pref_cig == 2)checked @endif/>
                            <label for="cig2"> éventuellement</label>

                            <input name="cig" type="radio" id="cig3" value="3" @if($user->membre_pref_cig == 3)checked @endif/>
                            <label for="cig3"> autorisé</label>

                            @if ($errors->first('cig'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cig') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <span>Animaux</span>

                            <input name="animaux" type="radio" id="animaux1" value="1" @if($user->membre_pref_ani == 1) checked @endif/>
                            <label for="animaux1"> pas autorisé</label>

                            <input name="animaux" type="radio" id="animaux2" value="2" @if($user->membre_pref_ani == 2) checked @endif/>
                            <label for="animaux2"> dépend de l'animal</label>

                            <input name="animaux" type="radio" id="animaux3" value="3" @if($user->membre_pref_mus == 3) checked @endif/>
                            <label for="animaux3"> autorisé</label>

                            @if ($errors->first('animaux'))
                            <span class="help-block">
                                <strong>{{ $errors->first('animaux') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            {{ Form::button('Mettre à jour',['class'=>'waves-effect waves-light btn btn-primary','type'=>'submit']) }}
                        </div>
                    </div>

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection