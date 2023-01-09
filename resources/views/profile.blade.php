@extends('layout.master')
@section('title', 'Profile')
@section('content')
<div class="background p-5" style="height: 1250px">
    <div class="container" style="width:700px">
        <div class="card" style="background: white; padding: 1rem">
        <center class="h3"><b>Profile</b></center>
        <hr>
        <center><img src="{{asset('storage/pfp_placeholder.webp')}}" class="rounded-circle" width="150px"><br></center>
        <center><h4 class="h4">{{ $user->name }}</h4><br></center>
        <h4 class="h4">Watchlist</h4>
            @if($watchlist->isNotEmpty())
                <div class="cards" style="overflow-x: auto">
                @foreach($watchlist as $wt)
                    <div class="card" style="width: 18rem;">
                        <a href="{{asset("details/".$wt->movie->id)}}">
                            <img class="card-img-top" src="{{asset("/storage/".$wt->movie->poster)}}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{$wt->movie->title}}</h5>
                                <p>{{$wt->movie->year}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
                </div>
            @else
                <h5 style="margin: 15px">You don't have any movies in your watchlist!</h5>
            @endif
        <h4 class="h4" style="margin-top: 3rem">Rented Movies</h4>
            @if($rented->isNotEmpty())
                <div class="cards">
                    @foreach($rented as $rent)
                        <div class="card" style="width: 18rem;">
                            <a href="{{-- asset("details/$rent->id") --}}">
                                <img class="card-img-top" src="/storage/{{-- $rent->poster --}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{-- $rent->title --}}</h5>
                                    <p>{{-- $rent->year --}}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <h5 style="margin: 15px">You haven't rented any movies!</h5>
            @endif
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
