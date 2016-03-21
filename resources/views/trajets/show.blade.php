@extends('layouts.app')

@section('content')
   <div class="row">
       <div class="col l8 offset-l2">
           <a href="{{ url('trip-offers') }}" class="waves-effect waves-light btn red darken-3"><i class="material-icons left">reply</i>Retour à mes annonces</a>

           <div class="row">
               <div class="col l12">
                   <h3>{{ $depart->ville_nom_reel }} <i class="material-icons icon-valign">arrow_forward</i> {{ $arrivee->ville_nom_reel }}</h3>
               </div>
           </div>

           <div class="row">
               <div class="col s7">
                   <div class="card">
                       <div class="card-content">
                           <div class="row">
                               <div class="col l4 blue-grey-text text-lighten-2">
                                   Départ
                               </div>
                               <div class="col l6">
                                   <i class="material-icons light-green-text">place</i> {{ $depart->ville_nom_reel }}
                               </div>
                           </div>

                           <div class="row">
                               <div class="col l4 blue-grey-text text-lighten-2">
                                   Arivée
                               </div>
                               <div class="col l6">
                                   <i class="material-icons red-text text-lighten-1">place</i> {{ $arrivee->ville_nom_reel }}
                               </div>
                           </div>

                           <div class="row">
                               <div class="col l4 blue-grey-text text-lighten-2">
                                   Date
                               </div>
                               <div class="col l6">
                                   <i class="material-icons icon-valign">date_range</i> {{ date('d F Y',strtotime($trajet->trajet_date)) }} à {{ date('H:i',strtotime($trajet->trajet_heure)) }}
                               </div>
                           </div>

                           <div class="row">
                               <div class="col l4 blue-grey-text text-lighten-2">
                                   Détails
                               </div>
                               <div class="col l6">
                                   @if($trajet->trajet_decalage_depart == 0)
                                       <i class="material-icons icon-valign">timer_off</i> Pas de retard
                                   @else
                                     <i class="material-icons icon-valign">timer</i> Départ à +/- {{ $trajet->trajet_decalage_depart}} minutes
                                   @endif
                               </div>
                           </div>

                           <div class="row">
                               <div class="col l6 offset-l4">
                                   @if($trajet->trajet_detour == 0)
                                       <i class="material-icons icon-valign">trending_up</i> Pas de détour
                                   @else
                                       <i class="material-icons icon-valign">gesture</i> Détour de  {{ $trajet->trajet_detour}} minutes
                                   @endif
                               </div>
                           </div>

                           <div class="row">
                               <div class="col l6 offset-l4">
                                   @if($trajet->trajet_bagage == 0)
                                       <i class="material-icons icon-valign">work</i> Pas de bagage
                                   @else
                                       <i class="material-icons icon-valign">work</i> @if($trajet->trajet_bagage == 1) Petits @elseif($trajet->trajet_bagage == 2) Moyens @elseif($trajet->trajet_bagage == 3) Grands @endif bagages
                                    @endif
                               </div>
                           </div>

                           <div class="row">
                               <div class="col l1">
                                   @if($trajet->user->membre_photo != '' && $trajet->user->membre_photo_valide == 1)
                                     <img src="{{ asset('img/uploads/'.$trajet->id.'/'.$trajet->user->membre_photo) }}" class="responsive-img circle img-trajet">
                                   @else
                                       <i class="material-icons">photo_camera</i>
                                   @endif
                               </div>
                               <div class="col l10 red lighten-5">
                                   <p><strong>{{ $trajet->user->membre_prenom }} {{ $trajet->user->name[0] }}</strong></p>
                                   @if($trajet->trajet_info == '')
                                       Le conducteur n'a pas donné plus de détails sur son trajet.
                                   @else
                                        {{ $trajet->trajet_info }}
                                   @endif
                               </div>
                           </div>
                       </div>
                    </div>

                   <div class="card">
                       <div class="card-content">
                           <div class="row">
                               <div class="col l12 left-align">
                                   <h3>Questions</h3>
                               </div>
                           </div>

                           <div class="row">
                               @forelse($questions as $question)
                                       <div class="col s12">
                                           <div class="card">

                                               <div class="card-content">
                                                   <span class="card-title">
                                                       @if($question->user->membre_photo != '')
                                                           <img src="{{ asset('img/uploads/'.$question->id.'/'.$question->user->membre_photo) }}" class="responsive-img circle img-trajet">
                                                       @else
                                                           <i class="material-icons valign">photo_camera</i>
                                                       @endif
                                                       {{ $question->user->membre_prenom }} {{ $question->user->name[0] }} </span>
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
                                                                       {{ $reponse->user->membre_prenom }} {{ $reponse->user->name[0] }} </span>
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

                                               @if(($trajet->id == Auth::user()->id || $question->id == Auth::user()->id) && $trajet->trajet_date >= date('Y-m-d'))
                                                   <div class="card-action">
                                                       <div class="row">
                                                           {{ Form::open(array('route' => 'reponse.store')) }}
                                                           <div class="input-field col s12">
                                                               {{ Form::hidden('id',Auth::user()->id) }}
                                                               {{ Form::hidden('question_id',$question->question_id) }}
                                                               {{ Form::hidden('trajet_id',$trajet->trajet_id) }}

                                                               {{ Form::textarea('reponse',null,array('class'=>'materialize-textarea','id'=>'reponse','length'=>'255')) }}
                                                               {{ Form::label('reponse','Votre réponse') }}

                                                               {{ Form::button('Répondre',['class'=>'waves-effect waves-light btn btn-primary','type'=>'submit']) }}
                                                           </div>
                                                           {{ Form::close() }}
                                                       </div>
                                                   </div>
                                               @endif
                                           </div>
                                       </div>
                               @empty
                                   Il n'y a pas encore de questions pour ce trajet.
                               @endforelse
                           </div>

                           @if($trajet->trajet_date >= date('Y-m-d'))
                               <hr>

                               <div class="row">
                                   {{ Form::open(array('route' => 'question.store')) }}
                                       <div class="input-field col s12">
                                           {{ Form::hidden('id',Auth::user()->id) }}
                                           {{ Form::hidden('trajet_id',$trajet->trajet_id) }}

                                           {{ Form::textarea('question',null,array('class'=>'materialize-textarea','id'=>'question','length'=>'255')) }}
                                           {{ Form::label('question','Votre question') }}

                                           {{ Form::button('Poser une question',['class'=>'waves-effect waves-light btn btn-primary','type'=>'submit']) }}
                                       </div>
                                   {{ Form::close() }}
                               </div>
                           @endif
                       </div>
                   </div>

                   <div class="card">
                       <div class="card-content">
                           <div class="row">
                               <div class="col l12 left-align">
                                   <h3>Itinéraire</h3>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col l12 blue-grey-text text-lighten-2">
                                   Distance : {{ $trajet->trajet_distance }}km - Durée estimée : {{ date('H',strtotime($trajet->trajet_duree)) }}h {{ date('i',strtotime($trajet->trajet_duree)) }}min
                               </div>
                           </div>
                           <div class="row">
                               <div>
                                   <div class="timeline">
                                       @foreach($etapes as $etape)
                                           <div class="timeline-event">
                                               <div class="card timeline-content">
                                                   <div class="card-image waves-effect waves-block waves-light">
                                                   </div>
                                                   <div class="card-content">
                                                       <span class="card-title activator grey-text text-darken-4">{{ $etape->ville->ville_nom_reel }}</span>
                                                       @if($etape->etape_ordre == 1)
                                                           <p>Départ : {{ date('H',strtotime($trajet->trajet_heure)) }}h{{ date('i',strtotime($trajet->trajet_heure)) }}</p>
                                                       @elseif($etape->etape_ordre == $nbEtapes)
                                                           <?php
                                                           $depart = date("H:i",strtotime($trajet->trajet_heure));
                                                           $h2 = date("H",strtotime($etape->etape_duree)) ;
                                                           $addHeure = date("H:i", strtotime("+".$h2." hour", strtotime($depart)));
                                                           $min2 = date("i",strtotime($etape->etape_duree));
                                                           $addMin = date("H:i", strtotime("+".$min2." minutes", strtotime($addHeure)));

                                                           echo "<p>Arrivée :~ ".date('H',strtotime($addMin)).'h'.date('i',strtotime($addMin)).'</p>'; ?>
                                                       @else
                                                           <?php
                                                           $depart = date("H:i",strtotime($trajet->trajet_heure));
                                                           $h2 = date("H",strtotime($etape->etape_duree)) ;
                                                           $addHeure = date("H:i", strtotime("+".$h2." hour", strtotime($depart)));
                                                           $min2 = date("i",strtotime($etape->etape_duree));
                                                           $addMin = date("H:i", strtotime("+".$min2." minutes", strtotime($addHeure)));

                                                           echo "<p>~ ".date('H',strtotime($addMin)).'h'.date('i',strtotime($addMin)).'</p>'; ?>
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
               </div>

               <div class="col s5">
                   <div class="card">
                       <div class="card-content">
                           <div class="row">
                               <div class="col l6 center-align">
                                    <h3>{{ $trajet->trajet_tarif }}€</h3>
                                   <br>
                                    <h4>par place</h4>
                               </div>
                               <div class="col l6 center-align">
                                    <h3>{{ $places }} places</h3>
                                   <br>
                                   <h4> disponibles</h4>
                               </div>
                           </div>
                       </div>
                   </div>

                   <div class="card">
                       <div class="card-content">
                           <div class="row">
                               <div class="col l12 center-align">
                                   <h3>Conducteur</h3>
                               </div>
                           </div>

                           <div class="row">
                               <div class="col l4">
                                   @if($trajet->user->membre_photo != '' && $trajet->user->membre_photo_valide == 1)
                                       <img src="{{ asset('img/uploads/'.$trajet->id.'/'.$trajet->user->membre_photo) }}" class="responsive-img circle">
                                   @else
                                       <i class="material-icons">photo_camera</i>
                                   @endif
                               </div>

                               <div class="col l8">
                                   <strong>{{ $trajet->user->membre_prenom }} {{ $trajet->user->name[0] }}</strong>
                                   <br>
                                   {{ date('Y')-$trajet->user->membre_annee_naissance }} ans
                                   <br>
                                   @if($exp < 3)
                                       Débutant
                                   @elseif($exp >= 3 && $exp < 10)
                                       Habitué
                                   @elseif($exp >= 10 && $exp<20)
                                       Familier
                                   @elseif($exp > 20)
                                       Expérimenté
                                   @endif
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
               </div>
           </div>
       </div>
   </div>
@endsection
