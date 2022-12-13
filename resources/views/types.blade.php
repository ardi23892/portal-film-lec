@extends('layout.master')
@section('title')
    Movie Type
@endsection
@section('content')
    <div class="background">
        <div class="container">
        <h3 class="subtitle"><b>Anime Collection</b></h3>
        <div class="cards">
            <div class="card" style="width: 18rem;">
                <a href="{{asset('details')}}">
                    <img class="card-img-top" src="/posters/Avengers Endgame.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><b>TITLE</b></h5>
                    </div>
                </a>
            </div>

            <div class="card" style="width: 18rem;">
                <a href="{{asset('details')}}">
                    <img class="card-img-top" src="/posters/Moonlight.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">TITLE</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>
@endsection
