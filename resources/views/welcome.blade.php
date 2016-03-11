@extends('layouts.app')

@section('content')
    <section class="landing">
            <div class="recherche-home">
                <span class="annonce">Trouver<br>votre<br>covoiturage</span>
                <form>
                    <div class="row">
                        <div class="input-field">
                            <i class="fa fa-location-arrow prefix"></i>
                            <input id="depart" type="text" class="validate">
                            <label for="depart">Départ</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <i class="fa fa-flag-checkered prefix"></i>
                            <input id="arrivee" type="text" class="validate">
                            <label for="arrivee">Arrivée</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="fa fa-calendar-check-o prefix"></i>
                            <input id="date" type="text" class="datepicker">
                            <label for="date">Date</label>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">Rechercher</button>
                    </div>
                </form>
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
