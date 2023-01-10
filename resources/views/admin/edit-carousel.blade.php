@extends('layout.admin-master')
@section('title')
    Edit Carousel Content | Portal Film
@endsection
@section('content')
    <div class="container">
        <h3 class="subtitle" style="color: black"><b>Edit Carousel Content</b></h3>
        <img src="{{asset("storage/$content->imagePath")}}" style="height: 360px; width: auto">
        <form action="{{ url("/admin/edit/carousel/$content->id") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ $content->title }}">
            </div>
            <div class="form-group">
                <label for="caption">Synopsis:</label>
                <textarea  name="caption" class="form-control" rows="5" id="caption">{{ $content->caption }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Poster Image</label>
                <input type="file" id="image" class="form-control" name="image">
            </div>
            <div>
                @if($errors->any())
                    <p class="text-danger">{{$errors->first()}}</p>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
@endsection
