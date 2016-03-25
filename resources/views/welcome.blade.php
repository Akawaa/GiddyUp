@extends('layouts.app')

@section('content')
    <section class="landing">
            <div class="recherche-home">
                <span class="annonce">Trouver<br>votre<br>covoiturage</span>
                {{ Form::open(array('url' => '/search')) }}
                <div class="row">
                    <div class="input-field col s12 {{ $errors->first('depart') ? ' has-error' : '' }}">
                        <i class="fa fa-location-arrow prefix"></i>
                        <input list="depart" name='depart' type="text" id="depart_input" class="form-control">
                        {{ Form::label('depart','Départ') }}

                        <datalist id="depart">
                        </datalist>

                        @if ($errors->first('depart'))
                            <span class="help-block">
                        <strong>{{ $errors->first('depart') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12 {{ $errors->first('arrivee') ? ' has-error' : '' }}">
                        <i class="fa fa-flag-checkered prefix"></i>
                        <input list="arrivee" name='arrivee' type="text" id="arrivee_input" class="form-control">
                        {{ Form::label('arrivee','Arrivée') }}

                        <datalist id="arrivee">
                        </datalist>

                        @if ($errors->first('arrivee'))
                            <span class="help-block">
                        <strong>{{ $errors->first('arrivee') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12  {{ $errors->first('date') ? ' has-error' : '' }}">
                        <i class="fa fa-calendar-check-o prefix"></i>
                        <input type="date" name='date' class="datepicker">
                        <label for="icon_prefix2">Date</label>

                        @if ($errors->first('date'))
                            <span class="help-block">
                        <strong>{{ $errors->first('date') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="input-field">
                        <button class="btn waves-effect waves-light btn-primary col s12" type="submit" name="action">Rechercher <i class="material-icons prefix">search</i></button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </section>
        <section class="homesection bg-secondary row">
            <img src="img/student.png" alt="Étudiant" class="img-left">
            <div class="section-content col l10 m9">
                <h2>Le covoiturage facile entre étudiants !</h2>
                <p>
                    GiddyUp, c’est le site qui vous permet de trouver un covoiturage facilement au départ ou en direction d’une université. Voyagez avec d’autres étudiants pour un trajet convivial et moins cher !
                </p>
            </div>
        </section>
        <section class="homesection bg-third row">
            <img src="img/tirelire.png" alt="Tirelire" class="img-right">
            <div class="section-content col l10 m9 pull-m3 pull-l2">
                <h2>Zéro taxes, voyagez à petit prix</h2>
                <p>
                    GiddyUp ne prend aucune taxe sur vos trajets, vous payez directement votre conducteur lors de votre trajet. Nous nous contentons de vous mettre en relation avec les autres voyageurs, gratuitement !
                </p>
            </div>
        </section>
        <section class="homesection bg-secondary row">
            <img src="img/giddycar.png" alt="GiddyCar" class="img-left">
            <div class="section-content col l10 m9">
                <h2>Économique et convivial, optez pour le covoiturage !</h2>
                <p>
                    Conducteur ? Partagez vos frais lors de vos trajets en emmenant avec vous d’autres étudiants<br>
                    Passager ? Contactez facilement un conducteur et voyagez moins cher et en toute sérénité !
                </p>
            </div>
        </section>
@endsection
@section('depart')
    <script type="text/javascript">

        $( document ).ready(function() {
            $('#depart_input').keyup(function(){
                if($(this).val().length > 0){
                    console.log($(this).val());

                    $.ajax({
                        url: 'getVilles',
                        type: "post",
                        data: {'ville':$(this).val()},
                        dataType: 'json',
                        success: function(data){
                            console.log(data);

                            $('#depart').text('');

                            for(var i=0;i<data.length;i++){
                                $('#depart').append('<option value="'+data[i].ville_nom_reel+' - '+data[i].departementVille+'">');
                            }

                        },
                        error: function(){
                            alert("Oups ! Une erreur s'est produite.");
                        }
                    });
                }
            });
        });
    </script>
@endsection

@section('arrivee')
    <script type="text/javascript">

        $( document ).ready(function() {
            $('#arrivee_input').keyup(function(){
                if($(this).val().length > 0){
                    console.log($(this).val());

                    $.ajax({
                        url: 'getVilles',
                        type: "post",
                        data: {'ville':$(this).val()},
                        dataType: 'json',
                        success: function(data){
                            console.log(data);

                            $('#arrivee').text('');

                            for(var i=0;i<data.length;i++){
                                $('#arrivee').append('<option value="'+data[i].ville_nom_reel+' - '+data[i].departementVille+'">');
                            }

                        },
                        error: function(){
                            alert("Oups ! Une erreur s'est produite.");
                        }
                    });
                }
            });
        });
    </script>
@endsection