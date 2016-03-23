@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col l3 m3 s12">
                <div class="collection">
                    <a href="comment.php" class="collection-item">Comment ça marche</a>
                    <a href="appli.php" class="collection-item active">Application Mobile</a>
                    <a href="team.php" class="collection-item">L'équipe GiddyUp</a>
                </div>
            </div>
            <div class="col l9 m8 s12">
                <img id="first" class="responsive-img" src="img/about/app_1.jpg" alt="appli">
                <div class="row">
                    <div class="col l12 m12 s12 center-align">
                        <h4>Disponible sur Android</h4>
                        <div class="row">
                            <div class="col l12 m12 s6 offset-s3 center-align">
                                <a href=""><img id="gp" class="responsive-img" src="img/about/gplay.png" alt="playstore"></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l12 m12">
                            <div class="card-panel teal" id="bg">
                                <div class="row">
                                    <div class="col l6 m6 s12">
                                        <div class="row">
                                            <img src="img/about/yuna.jpg" alt="photo_profil"  class="circle responsive-img profil col l3 m4 s3">
                                         <span class="white-text col m6 s8">
                                              "Tellement pratique! Je l'utilise toujours!"
                                         </span>
                                            <p class="col l9 m9 s9">
                                                <i class="material-icons star">star</i>
                                                <i class="material-icons star">star</i>
                                                <i class="material-icons star">star</i>
                                                <i class="material-icons star">star</i>
                                                <i class="material-icons star">star</i>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col l6 m6 s12">
                                        <div class="row">
                                            <img src="img/about/yuna.jpg" alt="photo_profil"  class="circle responsive-img profil col l3 m4 s3">
                                         <span class="white-text col m6 s8">
                                              "Super application! Simple et claire."
                                         </span>
                                            <p class="col l9 m9 s9">
                                                <i class="material-icons star">star</i>
                                                <i class="material-icons star">star</i>
                                                <i class="material-icons star">star</i>
                                                <i class="material-icons star">star</i>
                                                <i class="material-icons star">star</i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------------------------------Besoin de voyager---------------------------------->
                <div class="row">
                    <img src="img/about/tel2.png" alt="voyager" class="col l4 m1 offset-m3 s1 offset-s3" id="two">
                    <div class="col l8 m12 s12">
                        <h4>Besoin de voyager ?</h4>
                        <p class="subhead">Voyager à tout moment à moindre prix</p>
                        <div class="row">
                            <div class="col l4 m4 s4 icon">
                                <i class="material-icons ">search</i>
                            </div>
                            <div class="col l4 m4 s4 icon">
                                <i class="material-icons">supervisor_account</i>
                            </div>
                            <div class="col l4 m4 s4 icon">
                                <i class="material-icons">airline_seat_recline_extra</i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l4 m4 s4 text">
                                <span class="subtitle"><strong>Cherchez</strong></span>
                            </div>
                            <div class="col l4 m4 s4 text">
                                <span class="subtitle"><strong>Choisissez un chauffeur</strong></span>
                            </div>
                            <div class="col l4 m4 s4 text">
                                <span class="subtitle"><strong>Réservez sur l'application</strong></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l4 m4 s4 text_a">
                                <span class="text">Cherchez et consultez des offres de trajet à tout moment.</span>
                            </div>
                            <div class="col l4 m4 s4 text_a">
                                <span class="text">Consultez des profils de confiance.</span>
                            </div>
                            <div class="col l4 m4 s4 text_a">
                                <span class="text">Confirmez votre place instantanément puis voyagez ensemble !</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="col l12 m12 s12">
                <!----------------------------Des sièges disponibles------------------------>
                <div class="row">
                    <div class="col l9 m12">
                        <h4>Des sièges disponibles ?</h4>
                        <p class="subhead">Partagez vos frais de trajet avec des passagers de qualité </p>
                        <div class="row">
                            <div class="col l4 m4 s4 icon">
                                <i class="material-icons">add_circle_outline</i>
                            </div>
                            <div class="col l4 m4 s4 icon">
                                <i class="material-icons">supervisor_account</i>
                            </div>
                            <div class="col l4 m4 s4 icon">
                                <i class="material-icons">done</i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l4 m4 s4 text">
                                <span class="subtitle"><strong>Proposez un trajet</strong></span>
                            </div>
                            <div class="col l4 m4 s4 text">
                                <span class="subtitle"><strong>Choisissez avec qui vous voyagez</strong></span>
                            </div>
                            <div class="col l4 m4 s4 text">
                                <span class="subtitle"><strong>Confirmez les demandes</strong></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l4 m4 s4 text_a">
                                <span class="text">Créez un trajet afin de partager les frais avec des passagers.</span>
                            </div>
                            <div class="col l4 m4 s4 text_a">
                                <span class="text">Sélectionner vos passagers.</span>
                            </div>
                            <div class="col l4 m4 s4 text_a">
                                <span class="text">Approuvez les réservations reçues, et c'est parti !</span>
                            </div>
                        </div>
                    </div>
                    <div class="col s1 offset-s3 l3">
                        <img src="img/about/tel3.png" alt="création" id="three">
                    </div>

                </div>
                <div class="row">
                    <div class="col l9 m9 s9">
                        <div class="row">
                            <div class="col l10 offset-l2 m10 offset-m2 s12 offset-s2 center-align">
                                <h4>N'oubliez pas de télecharger notre application !</h4></div></div>
                        <div class="row">
                            <div class="col l4 offset-l5 m6 offset-m4 s9 offset-s3">
                                <a href=""><img id="gplay" class="responsive-img center-align" src="img/about/gplay.png" alt="playstore"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection