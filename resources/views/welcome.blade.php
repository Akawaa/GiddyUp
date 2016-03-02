@extends('layouts.app')

@section('content')
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


        <h5>Le covoiturage facile entre étudiants et/ou enseignants !</h5>
        <p>
            GiddyUp, c'est le site qui vous permet de trouver un covoiturage facilement au départ ou en direction d'une Université.
            <br>
            Voyagez avec d'autres étudiants et/ou enseignants pour un trajet convivial et moins cher.
        </p>

        <h5>Zéro taxes, voyagez à petit prix</h5>
        <p>
            GiddyUp ne prend aucune taxe sur vos trajets, vous payez directement votre conducteur lors de votre trajet.
            <br>
            Nous nous contentons de vous mettre en relation avec les autres vayageurs gratuitement !
        </p>

        <h5>Économique et convivial, optez pour le covoiturage</h5>
        <p>
            Conducteur ? Partagez vos frais lors de vos trajets en emmenant avec vous des étudiants et/ou enseignants.
            <br>
            Passager ? Contactez facilement un conducteur et voyager moins cher et en toute sécurité.
        </p>

        <div><strong>Jolies maison :D</strong></div>

        <div>
            <h5>Infos pratiques</h5>
            <ul>
                <li><a href="#">Comment ça marche ?</a></li>
                <li><a href="#">Prix des covoiturages</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">F.A.Q</a></li>
                <li><a href="#">Conditions générales</a></li>
            </ul>
        </div>

        <div>
            <h5>Infos pratiques 2</h5>
            <ul>
                <li><a href="#">Comment ça marche ?</a></li>
                <li><a href="#">Prix des covoiturages</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">F.A.Q</a></li>
                <li><a href="#">Conditions générales</a></li>
            </ul>
        </div>

        <div>
            <h5>Infos pratiques 3</h5>
            <ul>
                <li><a href="#">Comment ça marche ?</a></li>
                <li><a href="#">Prix des covoiturages</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">F.A.Q</a></li>
                <li><a href="#">Conditions générales</a></li>
            </ul>
        </div>

    </div>
@endsection
