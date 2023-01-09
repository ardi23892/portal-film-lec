<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use App\Models\Rent;
use App\Models\Type;
use App\Models\User;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //
    public function index()
    {
        $movies = Movie::query()->where('type_id', 1)->get();
        $movies = $movies->random(8);
        $series = Movie::query()->where('type_id',2)->get();
        $series = $series->random(8);
        $anime = Movie::query()->where('type_id', 3)->get();
        $anime = $anime->random(8);
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
        $recommended = $recommended->unique('id')->random(4);

        $wted=collect();

        if(Auth::check()){
            $wted = Watchlist::where([
                ['user_id','=',Auth::id()],
                ['movie_id','=', $id]
            ])->first();
        }

        $rented = collect();
        if(Auth::check()){
            $rented = Rent::where([
                ['user_id','=',Auth::id()],
                ['movie_id','=',$id]
            ])->first();
        }
//        dd($rented);

        $types= Type::all();
        $categories= Category::all();

        return view('details',[
            'movie'=>$movie,
            'title'=>$title,
            'types'=>$types,
            'categories'=>$categories,
            'recommended'=>$recommended,
            'wted'=>$wted,
            'rented'=>$rented
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

    public function search(Request $request){
        $keyword = $request->search;
        $content = Movie::where('title', 'like', "%".$keyword."%")->get();
        $subtitle = $keyword;

        $types= Type::all();
        $categories= Category::all();

        return view('search',[
            'title'=>'Admin | Portal Film',
            'subtitle'=>$subtitle,
            'content'=>$content,
            'types'=>$types,
            'categories'=>$categories
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
        $content = $content->sortBy('title', SORT_NATURAL);
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

    public function admin_search(Request $request){
        $keyword = $request->search;
        $content = Movie::where('title', 'like', "%".$keyword."%")->get();
        $subtitle = "Search/\"".$keyword."\"";

        $types= Type::all();
        $categories= Category::all();

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

        $user = User::find(Auth::id());

        $watchlist = Watchlist::where('user_id','=',Auth::user()->id)->get();
//        dd($watchlist);

        $rented = Rent::where('user_id','=',Auth::id())->get();

        $types= Type::all();
        $categories= Category::all();

        return view('profile',[
            'types'=>$types,
            'categories'=>$categories,
            'user'=>$user,
            'watchlist'=>$watchlist,
            'rented'=>$rented,
        ]);
    }

    public function index_edit_password(){

        $types= Type::all();
        $categories= Category::all();

        return view('auth.edit_password', [
            'types'=>$types,
            'categories'=>$categories
        ]);
    }
}
