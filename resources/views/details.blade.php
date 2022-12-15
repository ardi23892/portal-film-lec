@extends('layout.master')
@section('head')
    <link href="/css/details.css" rel="stylesheet">
@endsection
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="body" style="background-image: url('/storage/{{ $movie->backdrop }}')">
        <div class="movie-container">
            <div class="title">{{ $movie->title }}</div>
            <div class="synopsis">
                <p>{{ $movie->synopsis }}</p>
            </div>
            <button class="watchlist">Add to Watchlist</button>
            <button class="rent">Rent for Price</button>
            <img  class="poster" src="/storage/{{ $movie->poster }}" alt="Poster">
        </div>
    </div>
    <div class="background">
        <div class="container">
            <h3 class="subtitle"><b>You might also like...</b></h3>
            @foreach($recommended as $rec)
            <div class="cards">
                <div class="card" style="width: 18rem;">
                    <a href="{{asset("details/$rec->id")}}">
                        <img class="card-img-top" src="/storage/{{$rec->poster}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $rec->title }}</h5>
                            <p>{{ $rec->year }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
