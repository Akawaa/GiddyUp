@extends('layouts.app')

@section('content')
<h2>Rechercher un trajet</h2>

<div class="row">
    <div>
        <div class="row">
            <form class="col s5 white" method="post" action="">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">my_location</i>
                        <input id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix2">De</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">my_location</i>
                        <input id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix2">À</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">date_range</i>
                        <input type="date" class="datepicker">
                        <label for="icon_prefix2">Quand</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light" type="submit" name="action"> Rechercher
                            <i class="material-icons right">search</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection