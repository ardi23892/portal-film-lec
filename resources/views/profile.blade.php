@extends('layout.master')
@section('title', 'Profile')
@section('content')
<div class="background p-5" style="height: 86vh">
    <div class="container" style="width:700px">
        <div class="card" style="background: white; padding: 1rem">
        <center class="h3"><b>Profile</b></center>
        <hr>
        <center><img src="{{asset('storage/pfp_placeholder.webp')}}" class="rounded-circle" width="150px"><br></center>
        <center><h4 class="h4">{{ $user->name }}</h4><br></center>
        <h4 class="h4">Watchlist</h4>
        <div class="cards">
            {{-- @foreach($movies as $movie) --}}
                <div class="card" style="width: 18rem;">
                    <a href="{{-- asset("details/$movie->id") --}}">
                    <img class="card-img-top" src="/storage/{{-- $movie->poster --}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{-- $movie->title --}}</h5>
                        <p>{{-- $movie->year --}}</p>
                    </div>
                    </a>
                </div>
            {{-- @endforeach --}}
        </div>
        <h4 class="h4">Rented Movies</h4>
        <div class="cards">
            {{-- @foreach($movies as $movie) --}}
                <div class="card" style="width: 18rem;">
                    <a href="{{-- asset("details/$movie->id") --}}">
                    <img class="card-img-top" src="/storage/{{-- $movie->poster --}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{-- $movie->title --}}</h5>
                        <p>{{-- $movie->year --}}</p>
                    </div>
                    </a>
                </div>
            {{-- @endforeach --}}
        </div>
        <div>
            @if(session('success'))
                <div class="mb-2" style="padding: 20px">
                    <div class="alert alert-success">{{ session('success') }}</div>
                </div>
            @endif
          <hr>
          <center><a href="{{route('index_edit_password')}}">Change account password</a><br></center>
        </div>
    </div>
  </div>
</div>
@endsection
