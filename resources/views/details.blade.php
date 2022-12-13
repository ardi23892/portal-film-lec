@extends('layout.master')
@section('head')
    <link href="/css/details.css" rel="stylesheet">
@endsection
@section('title')
    Movie Title | Portal Film
@endsection
@section('content')
    <div class="body" style="background-image: url('/backdrop/John Wick Parabellum.jpg')">
        <div class="movie-container">
            <div class="title">John Wick 3: Parabellum</div>
            <div class="synopsis">
                <p>After gunning down a member of the High Table legendary hit man John Wick finds himself stripped of the<br>
                    organization's protective services. Now stuck with a $14 million bounty on his head, Wick must fight his<br>
                    way through the streets of New York as he becomes the target of the world's most ruthless killers.</p>
            </div>
            <button class="watchlist">Add to Watchlist</button>
            <button class="rent">Rent for Price</button>
            <img  class="poster" src="/posters/John Wick Parabellum.jpg" alt="Poster">
        </div>
    </div>
@endsection
