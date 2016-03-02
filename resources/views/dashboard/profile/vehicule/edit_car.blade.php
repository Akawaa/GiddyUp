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
                <a href="{{ url('/profile') }}" class="collection-item red-text text-darken-3">Informations personnelles</a>
                <a href="{{ url('/profile/university') }}" class="collection-item red-text text-darken-3">Université</a>
                <a href="{{ url('/profile/picture') }}" class="collection-item red-text text-darken-3">Photo</a>
                <a href="{{ url('/profile/preferences') }}" class="collection-item red-text text-darken-3">Préférence</a>
                <a href="{{ url('/profile/car') }}" class="collection-item red darken-3 active">Véhicule</a>
                <a href="{{ url('/profile/password') }}" class="collection-item red-text text-darken-3">Changer de mot de passe</a>
            </div>
        </div>

        <div class="col s9">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <h5>Véhicule</h5>
                            <a href="{{ url('profile/car') }}" class="waves-effect waves-light btn red darken-4">Annuler</a>

                            {{ Form::model($vehicule, array('route' => array('profile.car.update',$vehicule->vehicule_id),'method'=>'PUT')) }}


                            <div class="row">
                                <div class="input-field col s6">
                                    <select id="type" name="type">
                                        <option value="" disabled selected>--- Choisissez un type ---</option>

                                        @foreach($types as $type)
                                            <option value="{{ $type->type_id }}">{{ $type->type_libelle }}</option>
                                        @endforeach

                                    </select>
                                    <label for="type">Type de véhicule</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    <select id="marque" name="marque">
                                        <option value="" disabled selected>--- Choisissez une marque ---</option>

                                        @foreach($marques as $marque)
                                            <option value="{{ $marque->marque_id }}">{{ $marque->marque_libelle }}</option>
                                        @endforeach

                                    </select>
                                    <label for="marque">Marque</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    <select id="modele" name="modele">
                                        <option value="" disabled selected>--- Choisissez un modèle ---</option>

                                        @foreach($modeles as $modele)
                                            <option value="{{ $modele->modele_id }}" @if($modele->modele_id == $vehicule->modele_id) selected @endif>{{ $modele->modele_libelle }}</option>
                                        @endforeach

                                    </select>
                                    <label for="modele">Modèle</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    <select id="couleur" name="couleur">
                                        <option value="" disabled selected>--- Choisissez une couleur ---</option>

                                        @foreach($couleurs as $couleur)
                                            <option value="{{ $couleur->couleur_id }}" @if($couleur->couleur_id == $vehicule->couleur_id) selected @endif>{{ $couleur->couleur_libelle }}</option>
                                        @endforeach

                                    </select>
                                    <label for="couleur">Couleur</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    {{ Form::selectRange('place',1,9,$vehicule->vehicule_place) }}
                                    {{ Form::label('place','Place dans le véhicule ( incluant le conducteur )') }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    {{ Form::select('confort',array('1'=>'Basique','2'=>'Normal','3'=>'Confort','4'=>'Luxe'),$vehicule->vehicule_confort) }}
                                    {{ Form::label('confort','Confort') }}
                                </div>
                            </div>

                            <div class="row">
                                {{ Form::submit('Mettre à jour',['class'=>'waves-effect waves-light btn red darken-4']) }}
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
