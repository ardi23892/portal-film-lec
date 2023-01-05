@extends('layout.admin-master')
@section('title')
    Carousel | Portal Film
@endsection
@section('content')
    <div class="container">
        <h3 class="subtitle" style=""><b>/Carousel/Content List</b></h3>
        <a href="{{route('create')}}" class="btn btn-success">Add new content</a>
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
                    <td>{{ $ct->movie->title }}</td>
                    <td><img src="{{asset("storage/$ct->imagePath")}}" style="width: 100px; height: auto"></td>
                    <td>{{ $ct->caption }}</td>
                    <td>
                        <a href="/admin/edit/{{ $ct->id }}" class="btn btn-info">Edit</a>
                        <a class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
