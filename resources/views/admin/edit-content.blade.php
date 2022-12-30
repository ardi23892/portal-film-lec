@extends('layout.admin-master')
@section('title')
    {{ $content->title }} | Edit Content
@endsection
@section('content')
    <div class="container">
        <h3 class="subtitle" style="color: black"><b>Edit Content</b></h3>
        <table class="table table-bordered">
            <tr>
                <th>Poster Image</th>
                <th>Backdrop Image</th>
            </tr>
            <tr>
                <td><img src="{{asset("storage/$content->poster")}}" style="height: 360px; width: auto"></td>
                <td><img src="{{asset("storage/$content->backdrop")}}" style="height: 360px; width: auto"></td>
            </tr>
        </table>
        <form action="/admin/edit/{{ $content->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ $content->title }}">
            </div>
            <div class="form-group">
                <label for="year">Release Year:</label>
                <input type="number" min="1900" max="2023" step="1" value="{{ $content->year }}" name="year" class="form-control" id="year">
            </div>
            <div class="form-group">
                <label for="synopsis">Synopsis:</label>
                <textarea  name="synopsis" class="form-control" rows="5" id="synopsis">{{ $content->synopsis }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Rent Price:</label>
                <input type="number" min="29000" step="1000" value="{{ $content->price }}" name="price" class="form-control" id="price">
            </div>
            <div class="form-group">
                <label for="type">Content Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="1" {{ $content->type_id == 1 ? 'selected' : '' }}>Movie</option>
                    <option value="2" {{ $content->type_id == 2 ? 'selected' : '' }}>Series</option>
                    <option value="3" {{ $content->type_id == 3 ? 'selected' : '' }}>Anime</option>
                </select>
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
                    <input type="checkbox" class="btn-check" name="category[]" id="{{ $ctg->name }}" value="{{ $ctg->id }}" autocomplete="off"
                    {{ (in_array($ctg->id, $category) ? 'checked' : '')}}>
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
