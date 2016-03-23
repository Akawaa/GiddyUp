@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col l3 m3 s12">
                <div class="collection">
                    <a href="comment.php" class="collection-item">Comment ça marche</a>
                    <a href="appli.php" class="collection-item">Application Mobile</a>
                    <a href="team.php" class="collection-item active">L'équipe GiddyUp</a>
                </div>
            </div>
            <div class="col l9 m9">
                <div class="row">
                    <div class="col l12 m12 s12">
                        <h4>L'équipe GiddyUp</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col l12 m12 s12">
                        <span class="text" >Nous sommes une équipe d'étudiants à l'IUT de Gap. Ce site a été réalisé dans le cadre d'un projet tutoré.</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col l12 m12 s12">
                        <img src="img/about/team.png" alt="team" class="col s12">
                    </div>
                </div>
                <div class="row">
                    <div class="col l3 m3 s4">
                        <img src="img/about/caly.jpg" alt="photo_profil"  class="circle responsive-img profil">
                    </div>
                    <div class="col l9 m9 s8">
                        <div class="row">
                            <span class="name col m6 s12">Bérénice CALY</span>
                            <span class="col l12 m12 s12">Développeur Web - Back-office (Laravel 5)</span>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col l3 m3 s4">
                        <img src="img/about/gauthier.jpg" alt="photo_profil"  class="circle responsive-img profil">
                    </div>
                    <div class="col l9 m9 s8">
                        <div class="row">
                            <span class="name col m6 s12">Raphael GAUTHIER</span>
                            <span class="col l12 m12 s12">Développeur Web - Application mobile (AngularJS) - MySQL</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l3 m3 s4">
                        <img src="img/about/cugnod.JPG" alt="photo_profil"  class="circle responsive-img profil">
                    </div>
                    <div class="col l9 m9 s8">
                        <div class="row">
                            <span class="name col m6 s12">Sylvain CUGNOD</span>
                            <span class="col l12 m12 s12">Développeur Web - Webdesigner - Intégrateur Web</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l3 m3 s4">
                        <img src="img/about/mjid.jpg" alt="photo_profil"  class="circle responsive-img profil">
                    </div>
                    <div class="col l9 m9 s8">
                        <div class="row">
                            <span class="name col m6 s12">Manel M'JID</span>
                            <span class="col l12 m12 s12">Développeur Web - Intégrateur Web</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection