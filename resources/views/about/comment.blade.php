@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col l3 m3 s12">
                <!-------MENU------->
                <div class="collection">
                    <a href="comment.php" class="collection-item active">Comment ça marche</a>
                    <a href="appli.php" class="collection-item">Application Mobile</a>
                    <a href="team.php" class="collection-item">L'équipe GiddyUp</a>
                </div>
            </div>

            <div class="col l9 m8 s12">
                <h4>Comment ça marche ?</h4>

                <div class="row">
                    <div class="col l12 m12">
                        <ul class="tabs">
                            <li class="tab col l6 m6"><a class="active" href="#passenger">Vous êtes passager ? </a></li>
                            <li class="tab col l6 m6"><a href="#driver">Vous êtes conducteur ? </a></li>
                        </ul>
                    </div>
                    <div id="passenger" class="col l12 m12">
                        <div class="row">
                            <p class="col l10 m12 first">
                                Simple et économique : réservez facilement votre place en ligne et voyagez moins cher, en toute confiance. Même à la dernière minute !
                            </p>
                        </div>
                        <div class="row">
                            <div class="col l12 m12">
                                <img src="img/about/jeune.jpg" alt="passenger" id="passg">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l1 m1 s2">
                                <i class="material-icons">search</i>
                            </div>
                            <div class="col l5 m10 offset-m1 s10">
                                <span class="subtitle">1.  Recherchez votre trajet </span>
                                <p class="text">Entrez vos villes de départ et de destination, ainsi que votre date de voyage et choisissez parmi les conducteurs proposant des trajets qui vous conviennent. Si vous voulez des précisions sur un trajet, vous pouvez envoyer un message au conducteur.</p>
                            </div>
                            <div class="row">
                                <div class="col l4 offset-l1 m12">
                                    <div class="card grey darken-1">
                                        <div class="card-content white-text">
                                            <p> <i class="material-icons idea">lightbulb_outline</i>Pensez à regarder le profil des conducteurs : bio, photo, avis.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l1 m1 s2">
                                <i class="material-icons">event_available</i>
                            </div>
                            <div class="col l5 m10 offset-m1 s10">
                                <span class="subtitle">2. Réservez en ligne</span>
                                <p class="text">Vous réservez votre place en ligne. Votre conducteur est prévenu immédiatement de votre réservation par <strong>mail</strong> et <strong>SMS</strong>. Ensuite, appelez le conducteur pour régler les derniers détails du voyage de vive voix.</p>
                            </div>
                            <div class="row">
                                <div class="col l4 offset-l1 m12">
                                    <div class="card grey darken-1">
                                        <div class="card-content white-text">
                                            <p> <i class="material-icons idea">lightbulb_outline</i>En cas de prolème de dernière minute, vous pouvez annuler selon certaines conditions.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l1 m1 s2">
                                <i class="material-icons">directions_car</i>
                            </div>
                            <div class="col l5 m10 offset-m1 s10">
                                <span class="subtitle">3. Voyagez</span>
                                <p class="text">Rendez-vous au lieu de départ convenu, bien à l'heure de préference. Donnez la somme due au conducteur au cours du voyage, cela lui permettra de recevoir votre participation au trajet par la suite. Bonne route !</p>
                            </div>
                            <div class="row">
                                <div class="col l4 offset-l1 m12">
                                    <div class="card grey darken-1">
                                        <div class="card-content white-text">
                                            <p> <i class="material-icons idea">lightbulb_outline</i>N'oubliez pas de laisser un avis, afin d'aider les autres utilisateurs, et pouvoir voir l'avis laissé par votre conducteur.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>






                    <div id="driver" class="col l12 m12">
                        <div class="row">
                            <p class="col l10 m12 first">
                                Économique et convivial : partagez vos frais en prenant des passagers sympas lors de vos longs trajets en voiture.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col l12 m12">
                                <img src="img/about/psg.jpg" alt="driver" id="drive">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l1 m1 s2">
                                <i class="material-icons">add_circle_outline</i>
                            </div>
                            <div class="col l5 m10 offset-m1 s10">
                                <span class="subtitle">1.  Publiez votre annonce </span>
                                <p class="text">Indiquez la date et l'horaire de votre trajet, l'itinéraire et le prix par passager. Choisissez entre Acceptation Manuelle et Acceptation Automatique : en Acceptation Manuelle vous confirmez chaque passager vous-même, en Acceptation Automatique, la confirmation est immédiate et vous n'avez rien à faire.</p>
                            </div>
                            <div class="row">
                                <div class="col l4 offset-l1 m12">
                                    <div class="card grey darken-1" id="card">
                                        <div class="card-content white-text">
                                            <p> <i class="material-icons idea">lightbulb_outline</i>GiddyUp se charge de calculer le prix de votre trajet, selon le nombre de kms parcourus.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l1 m1 s2">
                                <i class="material-icons">event_available</i>
                            </div>
                            <div class="col l5 m10 offset-m1 s10">
                                <span class="subtitle">2. Vos passagers réservent en ligne</span>
                                <p class="text">Vos passagers réservent en ligne sur GiddyUp et vous êtes automatiquement prévenu(e) par e-mail et SMS à chaque nouvelle réservation. Ensuite, échangez avec vos passagers par téléphone pour régler les derniers détails du voyage.</p>
                            </div>
                            <div class="row">
                                <div class="col l4 offset-l1 m12">
                                    <div class="card grey darken-1">
                                        <div class="card-content white-text">
                                            <p> <i class="material-icons idea">lightbulb_outline</i>En cas d’annulation de dernière minute d’un passager, vous serez dédommagé(e) selon nos conditions.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l1 m1 s2 ">
                                <i class="material-icons">directions_car</i>
                            </div>
                            <div class="col l5 m10 offset-m1 s10 ">
                                <span class="subtitle">3. Voyagez et vous serez payé</span>
                                <p class="text">Rendez-vous au lieu de départ convenu, bien à l'heure! Demandez la somme convenu à chaque passager au cours du trajet quand vous le souhaitez.</p>
                            </div>
                            <div class="row">
                                <div class="col l4 offset-l1 m12">
                                    <div class="card grey darken-1">
                                        <div class="card-content white-text">
                                            <p> <i class="material-icons idea">lightbulb_outline</i>N'oubliez pas de mettre une photo de votre véhicule pour aidez les passagers à trouver votre voiture lors du rendez-vous.</p>
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