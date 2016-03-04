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
        <div class="col s3">
            <div class="collection">
                <a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}" class="collection-item active red darken-3">Informations personnelles</a>
                <a href="{{ url('/profile/university/'.Auth::user()->id.'/edit') }}" class="collection-item red-text text-darken-3">Université</a>
                <a href="{{ url('/profile/picture/'.Auth::user()->id.'/edit') }}" class="collection-item red-text text-darken-3">Photo</a>
                <a href="{{ url('/profile/preferences/'.Auth::user()->id.'/edit')  }}" class="collection-item red-text text-darken-3">Préférences</a>
                <a href="{{ url('/profile/car') }}" class="collection-item red-text text-darken-3">Véhicule</a>
                <a href="{{ url('/profile/email/'.Auth::user()->id.'/edit') }}" class="collection-item red-text text-darken-3">Changer d'adresse email</a>
                <a href="{{ url('/profile/password/'.Auth::user()->id.'/edit') }}" class="collection-item red-text text-darken-3">Changer de mot de passe</a>
            </div>
        </div>

        <div class="col s9">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <h5>Informations Personnelles</h5>
                            @if (session('status'))
                                <div>
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{Form::model($user,array('route' => array('profile.update',$user->id),'method'=>'PUT')) }}


                                <div class="row">
                                    <div class="input-field col s6">

                                    @if($user->membre_sexe == 'h')

                                        {{ Form::text('disabled','M',array('disabled','class'=>'validate')) }}

                                    @else

                                        {{ Form::text('disabled','Mme',array('disabled','class'=>'validate')) }}

                                    @endif
                                        {{ Form::label('disabled','Civilité',array('class'=>'active')) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                        {{ Form::text('prenom',$user->membre_prenom,array('class'=>'validate') ) }}
                                        {{ Form::label('prenom','Prénom',array('class'=>'active')) }}

                                        @if ($errors->first('prenom'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('prenom') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                    <div class="input-field col s6">
                                        {{ Form::text('nom',$user->name,array('class'=>'validate') ) }}
                                        {{ Form::label('nom','Nom',array('class'=>'active')) }}

                                        @if ($errors->first('nom'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nom') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            <div class="row">
                                <div class="input-field col s6">

                                    {{ Form::text('telephone',$user->membre_telephone,array('class'=>'validate') ) }}
                                    {{ Form::label('telephone','Téléphone',array('class'=>'active')) }}

                                    @if ($errors->first('telephone'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('telephone') }}</strong>
                                            </span>
                                    @endif

                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    {{ Form::selectRange('naissance',intval(date('Y')-18),intval(date('Y')-100),$user->membre_annee_naissance) }}
                                    {{ Form::label('naissance','Année de naissance') }}

                                    @if ($errors->first('naissance'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('naissance') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>


                            <div class="row">
                                <div class="input-field col s6">
                                    {{ Form::textarea('presentation',null,array('class'=>'materialize-textarea','placeholder'=>'Ex. : "Je suis étudiant à Gap et je vais souvent rendre visite à ma famille sur Marseille. J\'aime l\'informatique et suis passionné de musique."',$user->membre_presentation)) }}
                                    {{ Form::label('presentation','Présentation') }}

                                </div>

                                <div class="col s6">
                                    <p>Ne pas indiquer :</p>
                                    <ul>
                                        <li><i class="material-icons">close</i> Numéro de téléphone</li>
                                        <li><i class="material-icons">close</i> Détails sur votre compte Facebook</li>
                                        <li><i class="material-icons">close</i> Détails sur des trajats en particulier</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                {{ Form::button('Mettre à jour',['class'=>'waves-effect waves-light btn red darken-4','type'=>'submit']) }}
                            </div>

                            {{ Form::close() }}

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
