@extends('layout.master')
@section('head')
    <link href="/css/details.css" rel="stylesheet">
@endsection
@section('title')
    {{$title}}
@endsection
@section('content')
    @if ($message=Session::get('alert'))
        <script type="text/javascript">alert( '{{ $message }}')</script>
    @endif
    <div class="body" style="background-image: url('/storage/{{ $movie->backdrop }}')">
        <div class="movie-container">
            <div class="title">{{ $movie->title }}</div>
            <div class="synopsis">
                <p>{{ $movie->synopsis }}</p>
            </div>
            @if(\Illuminate\Support\Facades\Auth::check())
                @if($wted===null)
                    <form action="/watchlist/add/{{ $movie->id }}" method="POST">
                        @csrf
                        <button class="watchlist" type="submit">Add to Watchlist</button>
                    </form>
                @else
                    <form action="/watchlist/add/{{ $movie->id }}" method="POST">
                        @csrf
                        <button class="watchlisted" type="submit">Watchlisted ✔</button>
                    </form>
                @endif
                @if($rented===null)
                    <form action="/rent/add/{{ $movie->id }}" method="POST">
                        @csrf
                        <button class="rent" type="submit" onclick="return confirm('You will be purchasing this movie, confirm to proceed payment')">Purchase for Rp {{ number_format($movie->price) }}</button>
                    </form>
                @else
                        <a href="{{url("watch/$movie->id")}}" class="rent" type="submit">Play ▶</a>
                @endif
{{--                <a class="rent">Rent for Rp {{ number_format($movie->price) }}</a>--}}
            @else
                <a href="{{route('index_login')}}" class="watchlist">Add to Watchlist</a>
                <a href="{{route('index_login')}}" class="rent">Purchase for Rp {{ number_format($movie->price) }}</a>
            @endif
            <img  class="poster" src="/storage/{{ $movie->poster }}" alt="Poster">
        </div>
    </div>
    <div class="background">
        <div class="container">
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
