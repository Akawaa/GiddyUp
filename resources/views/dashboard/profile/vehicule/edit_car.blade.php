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
                <a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Informations personnelles</a>
                <a href="{{ url('/profile/university/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Université</a>
                <a href="{{ url('/profile/picture/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Photo</a>
                <a href="{{ url('/profile/preferences/'.Auth::user()->id.'/edit')  }}" class="collection-item text-primary">Préférence</a>
                <a href="{{ url('/profile/car') }}" class="collection-item bg-primary active">Véhicule</a>
                <a href="{{ url('/profile/email/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer d'adresse email</a>
                <a href="{{ url('/profile/password/'.Auth::user()->id.'/edit') }}" class="collection-item text-primary">Changer de mot de passe</a>            </div>
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
                                        <option value="" disabled selected>Type</option>

                                        @foreach($types as $type)
                                            <option @if($type->type_id == $typeCourant) selected @endif value="{{ $type->type_id }}">{{ $type->type_libelle }}</option>
                                        @endforeach

                                    </select>
                                    <label for="type">Type de véhicule</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    <select id="marque" name="marque">
                                        <option value="" disabled selected>Marque</option>

                                        @foreach($marques as $marque)
                                            <option @if($marque->marque_id == $marqueCourante) selected @endif value="{{ $marque->marque_id }}">{{ $marque->marque_libelle }}</option>
                                        @endforeach

                                    </select>
                                    <label for="marque">Marque</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    <select id="modele" name="modele">
                                        <option value="" disabled selected>Modèle</option>

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

    $('#type').change(function(){
        $.ajax({
            url: 'getMarque',
            type: "post",
            data: {'type':$('#type').val()},
            dataType: 'json',
            success: function(data){

            $('#marque').text('');
            $('#modele').text('');
            $('#modele').append('<option value="" disabled selected>Modèle</option>');
            $('#marque').append('<option value="" disabled selected>Marque</option>');

            $('select').material_select();

            for(var i=0;i<data.length;i++){
                $('#marque').append('<option value="'+data[i].marque_id+'">'+data[i].marque_libelle+'</option>')
            }

            $('select').material_select();

            },
            error: function(){
            alert("Oups ! Une erreur s'est produite.");
            }
        });
    });

    $('#marque').change(function(){
        $.ajax({
            url: 'getModele',
            type: "post",
            data: {'marque':$('#marque').val()},
            dataType: 'json',
            success: function(data){

            $('#modele').text('');
            $('#modele').append('<option value="" disabled selected>Modèle</option>');

            $('select').material_select();

            for(var i=0;i<data.length;i++){
                $('#modele').append('<option value="'+data[i].modele_id+'">'+data[i].modele_libelle+'</option>')
            }
            $('select').material_select();

            },
            error: function(){
            alert("Oups ! Une erreur s'est produite.");
            }
        });
    });

@endsection
