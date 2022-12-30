@extends('layout.master')
@section('title')
{{ $title }}
@endsection
@section('content')
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('/storage/carousel/John Wick Parabellum.jpg')">
                <div class="carousel-caption">
                    <h1><b>John Wick 3: Parabellum</b></h1>
                    <p>Caption placeholder Caption placeholder Caption placeholder Caption placeholder Caption placeholder Caption placeholder</p>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('/storage/carousel/Spy x Family.png')">
                <div class="carousel-caption">
                    <h1><b>Spy x Family</b></h1>
                    <p>Caption placeholder Caption placeholder Caption placeholder Caption placeholder Caption placeholder Caption placeholder</p>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('/storage/carousel/Avengers Endgame.jpg')">
                <div class="carousel-caption">
                    <h1><b>Avengers: Endgame</b></h1>
                    <p>Caption placeholder Caption placeholder Caption placeholder Caption placeholder Caption placeholder Caption placeholder</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="background">
        <div class="container">
        <h3 class="subtitle"><b>Trending Now</b></h3>
        <div class="cards">
            @foreach($movies as $movie)
                <div class="card" style="width: 18rem;">
                    <a href="{{asset("details/$movie->id")}}">
                    <img class="card-img-top" src="/storage/{{ $movie->poster }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie->title }}</h5>
                        <p>{{ $movie->year }}</p>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>
        <h3 class="subtitle"><b>New Episode Weekly</b></h3>
        <div class="cards">
            @foreach($series as $serial)
                <div class="card" style="width: 18rem;">
                    <a href="{{asset("details/$serial->id")}}">
                        <img class="card-img-top" src="/storage/{{ $serial->poster }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $serial->title }}</h5>
                            <p>{{ $serial->year }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <h3 class="subtitle"><b>Anime Collection</b></h3>
        <div class="cards">
            @foreach($anime as $ani)
                <div class="card" style="width: 18rem;">
                    <a href="{{asset("details/$ani->id")}}">
                        <img class="card-img-top" src="/storage/{{ $ani->poster }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $ani->title }}</h5>
                            <p>{{ $ani->year }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    </div>

@endsection
