@extends('layout.master')
@section('title')
    Search | Portal Film
@endsection
@section('content')
    <div class="background">
        <div class="container">
            <h3 class="subtitle"><b>Search: "{{ $subtitle }}"</b></h3>
            <div class="cards">
                @foreach($content as $ct)
                    <div class="card" style="width: 18rem;">
                        <a href="{{asset("details/$ct->id")}}">
                            <img class="card-img-top" src="/storage/{{ $ct->poster }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $ct->title }}</h5>
                                <p>{{ $ct->year }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
