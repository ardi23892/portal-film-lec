@extends('layout.admin-master')
@section('title')
{{ $title }}
@endsection
@section('content')
    <div class="container">
        <h3 class="subtitle" style=""><b>All Content List</b></h3>
        <table class="table table-stripped">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content Type</th>
                <th>Action</th>
            </tr>
            @foreach($content as $ct)
                <tr>
                    <td>{{ $ct->id }}</td>
                    <td>{{ $ct->title }}</td>
                    <td>{{ $ct->type['name'] }}</td>
                    <td>
                        <a class="btn btn-info">Edit</a>
                        <a class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td>
                    <a href="{{route('create')}}" class="btn btn-success">Add new content</a>
                </td>
            </tr>
        </table>
    </div>
@endsection
