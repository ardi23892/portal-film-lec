@extends('layout.admin-master')
@section('title')
{{ $title }}
@endsection
@section('content')
    <div class="container">
        <h3 class="subtitle" style=""><b>/{{ $subtitle }}/Content List</b></h3>
        <a href="{{route('create')}}" class="btn btn-success">+ Add new content</a>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Poster Image</th>
                <th>Released Year</th>
                <th style="width: 500px">Synopsis</th>
                <th>Content Type</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            @foreach($content as $ct)
                <tr>
                    <td>{{ $ct->id }}</td>
                    <td>{{ $ct->title }}</td>
                    <td><img src="{{asset("storage/$ct->poster")}}" style="width: 100px; height: auto"></td>
                    <td>{{ $ct->year }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($ct->synopsis, 380) }}</td>
                    <td>{{ $ct->type['name'] }}</td>
                    <td>{{ $ct->price }}</td>
                    <td>
                        <a href="/admin/edit/{{ $ct->id }}" class="btn btn-info">Edit</a>
                        <a class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
