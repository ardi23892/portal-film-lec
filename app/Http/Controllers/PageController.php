<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use App\Models\Type;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function index()
    {
        $movies = Movie::query()->where('type_id', 1)->get();
        $types= Type::all();
        $categories= Category::all();

        return view('home',[
            'title'=>'Home | Portal Film',
            'types'=>$types,
            'categories'=>$categories,
            'movies'=>$movies
        ]);
    }

    public function details($id)
    {
        $movie = Movie::find($id);
        $title = $movie->title." | Portal Film";
        $movie_ctg = $movie->category;
        $category = Category::find($movie_ctg[0]['id']);
        $recommended = $category->movie;

        $types= Type::all();
        $categories= Category::all();

        return view('details',[
            'movie'=>$movie,
            'title'=>$title,
            'types'=>$types,
            'categories'=>$categories,
            'recommended'=>$recommended
        ]);
    }

    public function types()
    {
        $types= Type::all();
        $categories= Category::all();

        return view('types',[
            'title'=>'Type name | Portal Film',
            'types'=>$types,
            'categories'=>$categories
        ]);
    }

    public function admin()
    {
        $content = Movie::all();
        $types= Type::all();
        $categories= Category::all();
        $subtitle = 'All';

        return view('admin.admin',[
            'title'=>'Admin | Portal Film',
            'subtitle'=>$subtitle,
            'content'=>$content,
            'types'=>$types,
            'categories'=>$categories
        ]);
    }
}
