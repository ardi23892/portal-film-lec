@extends('layout.master')
@section('head')
    <link href="/css/details.css" rel="stylesheet">
@endsection
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="body" style="background-image: url('/storage/{{ $movie->backdrop }}')">
        <iframe class="video" src="{{url("//www.youtube.com/embed/".$code)}}" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="background">
        <div class="container">
            <a href="{{route('detail', ['id'=>$movie->id])}}" style="padding-bottom: 5px" class="movie_title"><b>{{$movie->title}} ({{$movie->year}})</b></a>
            <p style="color: white">{{$movie->synopsis}}</p>
            <h3 class="subtitle"><b>You might also like...</b></h3>
            <div class="cards">
                @foreach($recommended as $rec)
                    <div class="card" style="width: 18rem; height: 550px">
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
