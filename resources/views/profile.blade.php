@extends('layout.master')
@section('title', 'Profile')
@section('content')
<div class="background p-5" style="height: 86vh">
    <div class="container" style="width:700px">
        <div class="card" style="background: white; padding: 1rem">
        <center class="h3"><b>Profile</b></center>
        <hr>
        <img src="{{asset('storage/pfp_placeholder.png')}}" class="rounded-circle" width="150px"><br>
        <h4 class="h4" style="margin-left: 15px;">John Doe</h4><br>
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
          <hr>
          <a href="reset-password">Change account password</a><br>
          <a class="btn btn-danger" href="auth/logout">Logout</a><br>
        </div>
    </div>
  </div>
</div>
@endsection
