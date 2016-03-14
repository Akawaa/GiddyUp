@extends('layouts.app')

@section('content')
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
            float: left;
            width: 60%;
            height: 100%;
        }
        #right-panel {
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }

        #right-panel select, #right-panel input {
            font-size: 15px;
        }

        #right-panel select {
            width: 100%;
        }

        #right-panel i {
            font-size: 12px;
        }

        #right-panel {
            margin: 20px;
            border-width: 2px;
            width: 20%;
            float: left;
            text-align: left;
            padding-top: 20px;
        }
        #directions-panel {
            margin-top: 20px;
            background-color: #cbcbcb;
            padding: 10px;
        }
    </style>


@endsection

@section('map')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcFXAOF5-waSJtu1bgXhQ1-EkPcPFboUA&signed_in=true&callback=initMap" async defer></script>
@endsection