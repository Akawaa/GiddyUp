@extends('layouts.app')
@section('content')
<div class="container">
  <a href="{{ url('trip-offers') }}" class="waves-effect waves-light btn btn-third"><i class="material-icons left">reply</i>Retour à mes annonces</a>
  <div class="card card-secondary">
    <h3 class="card-content">
    {{ $depart->ville_nom_reel }} <i class="material-icons icon-valign">arrow_forward</i> {{ $arrivee->ville_nom_reel }} <span class="light">à {{ date('H\hi',strtotime($trajet->trajet_heure)) }}</span>
    </h3>
  </div>
  <div class="row">
    <div class="col m7 s12">
      <div class="card">
        <div class="card-content">
          <div class="row">
            <h5 class="col m4 s6">Départ</h5>
            <p class="text-card col m8 s6">
            <i class="material-icons light-green-text icon-valign">place</i> <strong>{{ $depart->ville_nom_reel }}</strong></p>
          </div>
          <div class="row">
            <h5 class="col m4 s6">Arivée</h5>
            <p class="text-card col m8 s6"><i class="material-icons icon-valign red-text text-lighten-1">place</i> <strong>{{ $arrivee->ville_nom_reel }}</strong></p>
          </div>
          <div class="row">
            <h5 class="col m4 s6">Date</h5>
            <p class="text-card col m8 s6"><i class="material-icons icon-valign">date_range</i> <strong>{{ date('d F Y',strtotime($trajet->trajet_date)) }} à {{ date('H\hi',strtotime($trajet->trajet_heure)) }}</strong></p>
          </div>
          <div class="row">
            <h5 class="col m4 s6">Détails</h5>
            <p class="text-card col m8 s6">
              @if($trajet->trajet_decalage_depart == 0)
              <i class="material-icons icon-valign">timer_off</i> <strong>Pas de retard</strong>
              @else
              <i class="material-icons icon-valign">timer</i> <strong>Départ à +/- {{ $trajet->trajet_decalage_depart}} minutes</strong>
              @endif
            </p>
          </div>
          <div class="row">
            <p class="text-card col m8 offset-m4 s6 offset-s6">
              @if($trajet->trajet_detour == 0)
              <i class="material-icons icon-valign">trending_up</i> <strong>Pas de détour</strong>
              @else
              <i class="material-icons icon-valign">gesture</i> <strong>Détour : max. {{ $trajet->trajet_detour}} minutes</strong>
              @endif
            </p>
          </div>
          <div class="row">
            <p class="text-card col m8 offset-m4 s6 offset-s6">
              @if($trajet->trajet_bagage == 0)
              <i class="material-icons icon-valign">work</i> <strong></strong>Pas de bagage
              @else
              <i class="material-icons icon-valign">work</i> <strong>@if($trajet->trajet_bagage == 1) Petits @elseif($trajet->trajet_bagage == 2) Moyens @elseif($trajet->trajet_bagage == 3) Grands @endif bagages</strong>
              @endif
            </p>
          </div>
          <p class="alert alert-info">
            @if($trajet->trajet_info == '')
            Le conducteur n'a pas donné plus de détails sur son trajet.
            @else
            {{ $trajet->trajet_info }}
            @endif
          </p>
        </div>
      </div>
      <div class="card">
        <div class="card-content">
          <h3>Questions</h3>
          @forelse($questions as $question)
          <div class="card col s12">
            <div class="card-content">
              <span class="card-title">
                @if($question->user->membre_photo != '')
                <img src="{{ asset('img/uploads/'.$question->id.'/'.$question->user->membre_photo) }}" class="responsive-img circle img-trajet">
                @else
                <i class="material-icons icon-valign">account_circle</i>
                @endif
                {{ $question->user->membre_prenom }} {{ $question->user->name[0] }}
              </span>
              <p>{{ $question->question_libelle }}</p>
              <p class="blue-grey-text text-lighten-2 date-trajet">{{ date('d/m/Y à H:i',strtotime($question->created_at)) }}</p>
              @if($question->id == Auth::user()->id)
              {{ Form::open(array('url'=> 'question/'.$question->question_id)) }}
              {{ Form::hidden('_method', 'DELETE') }}
              {{ Form::button('<i class="material-icons right">clear</i> Supprimer', ['class' => 'waves-effect waves-light btn btn-third col','type'=>'submit']) }}
              {{ Form::close() }}
              @endif
              @foreach($reponses as $reponse)
              @if($question->question_id == $reponse->question_id)
              <div class="row">
                <div class="col s10 offset-s1">
                  <span class="card-title">
                    @if($reponse->user->membre_photo != '')
                    <img src="{{ asset('img/uploads/'.$reponse->id.'/'.$reponse->user->membre_photo) }}" class="responsive-img circle img-trajet">
                    @else
                    <i class="material-icons valign">photo_camera</i>
                    @endif
                    {{ $reponse->user->membre_prenom }} {{ $reponse->user->name[0] }}
                  </span>
                  <p>{{ $reponse->reponse_libelle }}</p>
                  <p class="blue-grey-text text-lighten-2 date-trajet">{{ date('d/m/Y à H:i',strtotime($reponse->created_at)) }}</p>
                  @if($reponse->id == Auth::user()->id)
                  {{ Form::open(array('url'=> 'reponse/'.$reponse->reponse_id)) }}
                  {{ Form::hidden('_method', 'DELETE') }}
                  {{ Form::button('<i class="material-icons right">clear</i> Supprimer', ['class' => 'waves-effect waves-light btn btn-third col','type'=>'submit']) }}
                  {{ Form::close() }}
                  @endif
                </div>
              </div>
              @endif
              @endforeach
            </div>
            @if($trajet->id == Auth::user()->id || $question->id == Auth::user()->id)
            <div class="card-action">
              {{ Form::open(array('route' => 'reponse.store')) }}
              {{ Form::hidden('id',Auth::user()->id) }}
              {{ Form::hidden('question_id',$question->question_id) }}
              {{ Form::hidden('trajet_id',$trajet->trajet_id) }}
              <div class="input-field col s12">
                {{ Form::textarea('reponse',null,array('class'=>'materialize-textarea','id'=>'reponse','length'=>'255')) }}
                {{ Form::label('reponse','Votre réponse') }}
              </div>
              {{ Form::button('Répondre',['class'=>'waves-effect waves-light btn btn-primary','type'=>'submit']) }}
              {{ Form::close() }}
            </div>
            @endif
          </div>
        </div>
        @empty
        <p class="margin">Il n'y a pas encore de questions pour ce trajet.</p>
        @endforelse
        <div class="divider"></div>
        <div class="row">
          {{ Form::open(array('route' => 'question.store')) }}
          {{ Form::hidden('id',Auth::user()->id) }}
          {{ Form::hidden('trajet_id',$trajet->trajet_id) }}
          <div class="input-field col s12">
            {{ Form::textarea('question',null,array('class'=>'materialize-textarea','id'=>'question','length'=>'255')) }}
            {{ Form::label('question','Votre question') }}
          </div>
          {{ Form::button('Soumettre votre question',['class'=>'waves-effect waves-light btn btn-primary','type'=>'submit']) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-content">
        <h3>Itinéraire</h3>
        <h5 class="light">
        Distance : {{ $trajet->trajet_distance }}km - Durée estimée : {{ date('H\hi',strtotime($trajet->trajet_duree)) }}min
        </h5>
        <div class="row">
          <div class="timeline">
            @foreach($etapes as $etape)
            <div class="timeline-event">
              <div class="card timeline-content">
                <div class="card-content">
                  <h4>{{ $etape->ville->ville_nom_reel }}</h4>
                  @if($etape->etape_ordre == 1)
                  <p>{{ date('H\hi',strtotime($trajet->trajet_heure)) }}</p>
                  @else
                  <?php
                  $depart = date("H\hi",strtotime($trajet->trajet_heure));
                  $h2 = date("H",strtotime($etape->etape_duree)) ;
                  $addHeure = date("H\hi", strtotime("+".$h2." hour", strtotime($depart)));
                  $min2 = date("i",strtotime($etape->etape_duree));
                  $addMin = date("H\hi", strtotime("+".$min2." minutes", strtotime($addHeure)));
                  echo "<p>Heure estimée : ".date('H\hi',strtotime($addMin)).'</p>'; ?>
                  @endif
                </div>
              </div>
              <div class="timeline-badge transparent @if($etape->etape_ordre == 1)light-green-text @elseif($etape->etape_ordre == $nbEtapes)red-text text-lighten-1 @endif"><i class="material-icons">place</i></div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col m5 s12">
    <div class="card">
      <div class="card-content row center-align">
        <div class="col s6">
          <h3>{{ $trajet->trajet_tarif }}€</h3>
          <h4 class="light">par place</h4>
        </div>
        <div class="col s6">
          <h3>{{ $trajet->trajet_place }} places</h3>
          <h4 class="light"> au départ</h4>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-content">
        <h3 class="center-align">Conducteur</h3>
        <div class="row">
          <div class="col m4 s12 center-align">
            @if($trajet->user->membre_photo != '' && $trajet->user->membre_photo_valide == 1)
            <img src="{{ asset('img/uploads/'.$trajet->id.'/'.$trajet->user->membre_photo) }}" class="responsive-img circle">
            @else
            <i class="material-icons large">account_circle</i>
            @endif
          </div>
          <div class="col m8 s12">
            <strong>{{ $trajet->user->membre_prenom }} {{ $trajet->user->name[0] }}</strong>
            <br>
            {{ date('Y')-$trajet->user->membre_annee_naissance }} ans
            <br>
            niveau d'experience (a calculer)
            <br>
            <i class="material-icons amber-text icon-valign">star</i> note globale (a calculer)
            <div class="row">
              <div class="col s3">
                @if($trajet->user->membre_pref_dis != '')
                @if($trajet->user->membre_pref_dis == 1)
                <img src="{{ asset('img/preferences/discussion1.png') }}" class="responsive-img">
                @elseif($trajet->user->membre_pref_dis == 2)
                <img src="{{ asset('img/preferences/discussion2.png') }}" class="responsive-img">
                @else
                <img src="{{ asset('img/preferences/discussion3.png') }}" class="responsive-img">
                @endif
                @endif
              </div>
              <div class="col s3">
                @if($trajet->user->membre_pref_mus != '')
                @if($trajet->user->membre_pref_mus == 1)
                <img src="{{ asset('img/preferences/musique1.png') }}" class="responsive-img">
                @elseif($trajet->user->membre_pref_mus == 2)
                <img src="{{ asset('img/preferences/musique2.png') }}" class="responsive-img">
                @else
                <img src="{{ asset('img/preferences/musique3.png') }}" class="responsive-img">
                @endif
                @endif
              </div>
              <div class="col s3">
                @if($trajet->user->membre_pref_cig != '')
                @if($trajet->user->membre_pref_cig == 1)
                <img src="{{ asset('img/preferences/cigarette1.png') }}" class="responsive-img">
                @elseif($trajet->user->membre_pref_cig == 2)
                <img src="{{ asset('img/preferences/cigarette2.png') }}" class="responsive-img">
                @else
                <img src="{{ asset('img/preferences/cigarette3.png') }}" class="responsive-img">
                @endif
                @endif
              </div>
              <div class="col s3">
                @if($trajet->user->membre_pref_ani != '')
                @if($trajet->user->membre_pref_ani == 1)
                <img src="{{ asset('img/preferences/animal1.png') }}" class="responsive-img">
                @elseif($trajet->user->membre_pref_ani == 2)
                <img src="{{ asset('img/preferences/animal2.png') }}" class="responsive-img">
                @else
                <img src="{{ asset('img/preferences/animal3.png') }}" class="responsive-img">
                @endif
                @endif
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col l12 center-align">
            <h3>Véhicule</h3>
          </div>
        </div>
        <div class="row">
          <div class="col l8">
            {{ $trajet->vehicule->modele->marque->marque_libelle }} - {{ $trajet->vehicule->modele->modele_libelle}}
            <br>
            <i class="material-icons icon-valign">stars</i> {{ $trajet->vehicule->vehicule_confort }}
            <br>
            Couleur : {{ $trajet->vehicule->couleur->couleur_libelle }}
          </div>
          <div class="col l4">
            @if($trajet->vehicule->vehicule_photo == '')
            @if($trajet->vehicule->modele->marque->type->type_id == 1)
            <i class="material-icons large">directions_car</i>
            @else
            <i class="material-icons large">motorcycle</i>
            @endif
            @else
            <img src="{{ asset('img/uploads/'.$trajet->id.'/'.$trajet->vehicule->vehicule_photo) }}" class="responsive-img circle">
            @endif
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col l12 center-align">
            <h3>Avis</h3>
          </div>
        </div>
        <div class="row">
          <div class="col l12">
            @forelse($avis as $avi)
            @empty
            Le conducteur n'a pas encore d'avis.
            @endforelse
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col l12 center-align">
            <h3>Activité</h3>
          </div>
        </div>
        <div class="row">
          <div class="col l12">
            <div class="row">
              <div class="col l6 blue-grey-text text-lighten-2">
                Trajets publiés
              </div>
              <div class="col l6">
                {{ $nbTrajets }}
              </div>
            </div>
            <div class="row">
              <div class="col l6 blue-grey-text text-lighten-2">
                Date d'inscription
              </div>
              <div class="col l6">
                {{ date('d F Y',strtotime($trajet->user->created_at)) }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endsection