@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        <ul class="subonglet">
            <li class="onglet col m3 s12"><a href="{{ url('/home') }}">Tableau de bord</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/trip-offers') }}">Mes annonces</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/bookings') }}">Mes réservations</a></li>
            <li class="onglet col m3 s12"><a class="active" href="{{ url('/ratings') }}">Avis</a></li>
            <li class="onglet col m3 s12"><a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}">Profil</a></li>
        </ul>
    </div>


    <div class="col m3 s12">
        <div class="collection">
            <a href="{{ url('/ratings') }}" class="collection-item active bg-primary">Laisser un avis</a>
            <a href="{{ url('/ratings-received') }}" class="collection-item text-primary">Avis reçus</a>
            <a href="{{ url('/ratings-given') }}" class="collection-item text-primary">Avis laissés</a>
        </div>
    </div>

    <div class="col m9 s12">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col l6">
                        <h3>Avis donnés aux voyageurs</h3>

                        @forelse($conducteurs as $conducteur)
                            <div class="card">
                                <div class="card-content">
                                    Laisser un commentaire à <a class="link" href="{{ url('profile/show/'.$conducteur->id) }}">{{ $conducteur->membre_prenom }} {{ $conducteur->name[0] }}</a> :
                                        {{ Form::open(array('route' => 'ratings.store')) }}

                                        {{Form::hidden('idInscrit',$conducteur->id)}}
                                        {{Form::hidden('idTrajet',$conducteur->trajet_id)}}

                                        {{ Form::hidden('place',1) }}

                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <textarea id="textarea1"  name='comment' class="materialize-textarea"></textarea>
                                                    <label for="textarea1">Commentaire</label>
                                                </div>
                                            </div>

                                        <p>
                                            Quelle note lui donnez-vous ?
                                            <br>
                                            <input class="with-gap" name="note" type="radio" id="1"  value="1"/>
                                            <label for="1">1</label>
                                            <input class="with-gap" name="note" type="radio" id="2"  value="2"/>
                                            <label for="2">2</label>
                                            <input class="with-gap" name="note" type="radio" id="3"  value="3"/>
                                            <label for="3">3</label>
                                            <input class="with-gap" name="note" type="radio" id="4"  value="4"/>
                                            <label for="4">4</label>
                                            <input class="with-gap" name="note" type="radio" id="5"  value="5"/>
                                            <label for="5">5</label>
                                        </p>
                                        <div class="row right-align">
                                            <button type="submit" class="waves-effect waves-light btn btn-primary">Poster !</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">Il n'y a pas encore d'avis en tant que conducteur</div>
                        @endforelse
                    </div>

                    <div class="col l6">
                        <h3>Avis donnés aux conducteurs</h3>

                        @forelse($passagers as $passager)
                            <div class="card">
                                <div class="card-content">
                                    Laisser un commentaire à <a class="link" href="{{ url('profile/show/'.$passager->id) }}">{{ $passager->membre_prenom }} {{ $passager->name[0] }}</a> :
                                    {{ Form::open(array('route' => 'ratings.store')) }}

                                    {{Form::hidden('idInscrit',$passager->id)}}
                                    {{Form::hidden('idTrajet',$passager->trajet_id)}}

                                    {{ Form::hidden('place',2) }}

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <textarea id="textarea1"  name='comment' class="materialize-textarea"></textarea>
                                            <label for="textarea1">Commentaire</label>
                                        </div>
                                    </div>

                                    <p>
                                        Quelle note lui donnez-vous ?
                                        <br>
                                        <input class="with-gap" name="note" type="radio" id="1"  value="1"/>
                                        <label for="1">1</label>
                                        <input class="with-gap" name="note" type="radio" id="2"  value="2"/>
                                        <label for="2">2</label>
                                        <input class="with-gap" name="note" type="radio" id="3"  value="3"/>
                                        <label for="3">3</label>
                                        <input class="with-gap" name="note" type="radio" id="4"  value="4"/>
                                        <label for="4">4</label>
                                        <input class="with-gap" name="note" type="radio" id="5"  value="5"/>
                                        <label for="5">5</label>
                                    </p>
                                    <div class="row right-align">
                                        <button type="submit" class="waves-effect waves-light btn btn-primary">Poster !</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">Il n'y a pas encore d'avis en tant que voyageur</div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
