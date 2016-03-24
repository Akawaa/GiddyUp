@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Rechercher un trajet</h2>
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