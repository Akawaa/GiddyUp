@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <ul class="subonglet">
                <li class="onglet col s3"><a href="{{ url('/home') }}">Tableau de bord</a></li>
                <li class="onglet col s3"><a href="{{ url('/trip-offers/active') }}">Mes annonces</a></li>
                <li class="onglet col s3"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
                <li class="onglet col s3"><a href="{{ url('/ratings') }}">Avis</a></li>
                <li class="onglet col s3"><a class="active" href="{{ url('/profile') }}">Profil</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col s3">
            <div class="collection">
                <a href="{{ url('/profile') }}" class="collection-item active red darken-3">Informations personnelles</a>
                <a href="{{ url('/profile/university') }}" class="collection-item red-text text-darken-3">Université</a>
                <a href="{{ url('/profile/picture') }}" class="collection-item red-text text-darken-3">Photo</a>
                <a href="{{ url('/profile/preferences') }}" class="collection-item red-text text-darken-3">Préférences</a>
                <a href="{{ url('/profile/car') }}" class="collection-item red-text text-darken-3">Véhicule</a>
                <a href="{{ url('/profile/password') }}" class="collection-item red-text text-darken-3">Changer de mot de passe</a>
            </div>
        </div>

        <div class="col s9">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <h5>Informations Personnelles</h5>

                            {{Form::open(array('url' => '/profile')) }}


                                <div class="row">
                                    <div class="input-field col s6">

                                    @if(Auth::user()->membre_sexe == 'h')

                                        {{ Form::text('disabled','M',array('disabled','class'=>'validate')) }}

                                    @else

                                        {{ Form::text('disabled','Mme',array('disabled','class'=>'validate')) }}

                                    @endif
                                        {{ Form::label('disabled','Civilité',array('class'=>'active')) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                        {{ Form::text('prenom',Auth::user()->membre_prenom,array('class'=>'validate') ) }}
                                        {{ Form::label('prenom','Prénom',array('class'=>'active')) }}

                                    </div>

                                    <div class="input-field col s6">
                                        {{ Form::text('nom',Auth::user()->name,array('class'=>'validate') ) }}
                                        {{ Form::label('nom','Nom',array('class'=>'active')) }}
                                    </div>
                                </div>


                            <div class="row">
                                <div class="input-field col s6">

                                    {{ Form::email('email',Auth::user()->email,array('class'=>'validate') ) }}
                                    {{ Form::label('email','Email',array('class'=>'active')) }}

                                </div>

                                <div class="input-field col s6">

                                    {{ Form::text('telephone',Auth::user()->membre_telephone,array('class'=>'validate') ) }}
                                    {{ Form::label('telephone','Téléphone',array('class'=>'active')) }}

                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    {{ Form::selectRange('naissance',intval(date('Y')-18),intval(date('Y')-100),Auth::user()->membre_annee_naissance) }}
                                    {{ Form::label('naissance','Année de naissance') }}
                                </div>
                            </div>


                            <div class="row">
                                <div class="input-field col s6">
                                    {{ Form::textarea('presentation',null,array('class'=>'materialize-textarea','placeholder'=>'Ex. : "Je suis étudiant à Gap et je vais souvent rendre visite à ma famille sur Marseille. J\'aime l\'informatique et suis passionné de musique."')) }}
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


                            {{ Form::close() }}

                            <form>


                                <div class="row">
                                    {{ Form::submit('Mettre à jour',['class'=>'waves-effect waves-light btn red darken-4']) }}
                                </div>
                        </form>
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
