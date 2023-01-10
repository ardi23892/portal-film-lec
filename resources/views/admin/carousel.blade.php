@extends('layout.admin-master')
@section('title')
    Carousel | Portal Film
@endsection
@section('content')
    <div class="container">
        @if(session('success'))
            <div class="mb-2" style="padding: 20px">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        @endif
        <h3 class="subtitle" style=""><b>/Carousel/Content List</b></h3>
            @if($ct_count<3)
                <a href="{{route('create.carousel')}}" class="btn btn-success">Add new content</a>
            @else
                <button class="btn btn-success" disabled>Add new content</button>
                <p style="color: red">Carousel item has reached its limit(3)!</p>
            @endif
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Poster Image</th>
                <th>Title</th>
                <th style="width: 500px">Caption</th>
                <th>Action</th>
            </tr>
            @foreach($content as $ct)
                <tr>
                    <td>{{ $ct->id }}</td>
                    <td><img src="{{asset("storage/$ct->imagePath")}}" style="width: 300px; height: auto"></td>
                    <td>{{$ct->title}}</td>
                    <td>{{ $ct->caption }}</td>
                    <td>
                        <a href="{{url("/admin/edit/carousel/$ct->id")}}" class="btn btn-info">Edit</a>
                        <a href="{{url("/admin/delete/carousel/$ct->id")}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete content?')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
