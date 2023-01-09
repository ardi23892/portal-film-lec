@extends('layout.admin-master')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="container">
        <h3 class="subtitle" style="color: black"><b>New Content</b></h3>
        <form action="{{ route('create_new_content') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="year">Release Year:</label>
                <input type="number" min="1900" max="2023" step="1" value="2023" name="year" class="form-control" id="year">
            </div>
            <div class="form-group">
                <label for="synopsis">Synopsis:</label>
                <textarea  name="synopsis" class="form-control" rows="5" id="synopsis">{{ old('synopsis') }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Rent Price:</label>
                <input type="number" min="29000" step="1000" value="29000" name="price" class="form-control" id="price">
            </div>
            <div class="form-group">
                <label for="type">Content Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="1">Movie</option>
                    <option value="2">Series</option>
                    <option value="3">Anime</option>
                </select>
            </div>
            <div class="form-group">
                <label for="url">Movie URL:</label>
                <input type="url" name="url" class="form-control" id="url" value="{{ old('url') }}">
            </div>
            <div class="form-group">
                <label for="poster">Poster Image</label>
                <input type="file" id="poster" class="form-control" name="poster">
            </div>
            <div class="form-group">
                <label for="backdrop">Backdrop Image</label>
                <input type="file" id="backdrop" class="form-control" name="backdrop">
            </div>
            <div>Category</div>
            @foreach($categories as $ctg)
                <div class="form-group form-check-inline">
                    <input type="checkbox" class="btn-check" name="category[]" id="{{ $ctg->name }}" value="{{ $ctg->id }}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="{{ $ctg->name }}">{{ $ctg->name }}</label><br>
                </div>
            @endforeach
            <div>
                @if($errors->any())
                    <p class="text-danger">{{$errors->first()}}</p>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
@endsection
