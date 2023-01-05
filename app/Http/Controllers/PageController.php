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
        $series = Movie::query()->where('type_id',2)->get();
        $anime = Movie::query()->where('type_id', 3)->get();
        $types= Type::all();
        $categories= Category::all();

        return view('home',[
            'title'=>'Home | Portal Film',
            'types'=>$types,
            'categories'=>$categories,
            'movies'=>$movies,
            'series'=>$series,
            'anime'=>$anime
        ]);
    }

    public function details($id)
    {
        $movie = Movie::find($id);
        $title = $movie->title." | Portal Film";
        $movie_ctg = $movie->category;

        $recommended=collect();
        foreach ($movie_ctg as $ctg) {
            $category = Category::find($ctg->id);
            $category_content = $category->movie;
            $recommended = $recommended->concat($category_content);
        }
        $recommended = $recommended->unique('id')->all();


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

    public function types($id)
    {
        $content = Movie::query()->where('type_id', $id)->get();
        $type = Type::find($id);
        $types= Type::all();
        $categories= Category::all();

        return view('types',[
            'types'=>$types,
            'type'=>$type,
            'categories'=>$categories,
            'content'=>$content,
        ]);
    }

    public function categories($id){

        $category = Category::find($id);
        $content = $category->movie;
        $types= Type::all();
        $categories= Category::all();

        return view('types', [
            'types'=>$types,
            'type'=>$category,
            'categories'=>$categories,
            'content'=>$content,
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

    public function index_register(){

        $types= Type::all();
        $categories= Category::all();

        return view('auth.register', [
            'types'=>$types,
            'categories'=>$categories
        ]);
    }

    public function index_login(){

        $types= Type::all();
        $categories= Category::all();

        return view('auth.login',[
            'types'=>$types,
            'categories'=>$categories
        ]);
    }

    public function profile(){

        $types= Type::all();
        $categories= Category::all();

        return view('profile',[
            'types'=>$types,
            'categories'=>$categories
        ]);
    }
}
