<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Movie_Category;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function create()
    {
        $types= Type::all();
        $categories= Category::all();

        return view('admin.create-content',[
            'title'=>'Create New Content | Portal Film',
            'types'=>$types,
            'categories'=>$categories
        ]);
    }

    public function create_carousel(){
        $types= Type::all();
        $categories= Category::all();

        return view('admin.create-carousel',[
            'title'=>'Create New Carousel | Portal Film',
            'types'=>$types,
            'categories'=>$categories
        ]);
    }


    public function category($id){
        $types= Type::all();
        $categories= Category::all();

        $category = Category::find($id);
        $content = $category->movie;
        $content = $content->sortBy('title', SORT_NATURAL);
        $title = $category->name.' | Portal Film';
        $subtitle = 'Category/'.$category->name;

        return view('admin.admin',[
            'title'=>$title,
            'subtitle'=>$subtitle,
            'content'=>$content,
            'types'=>$types,
            'categories'=>$categories
        ]);
    }


    public function type($id){
        $types= Type::all();
        $categories= Category::all();

        $type = Type::find($id);
        $content = $type->movie;
        $content = $content->sortBy('title', SORT_NATURAL);
        $title = $type->name.' | Portal Film';
        $subtitle = 'Type/'.$type->name;

        return view('admin.admin',[
            'title'=>$title,
            'subtitle'=>$subtitle,
            'content'=>$content,
            'types'=>$types,
            'categories'=>$categories
        ]);
    }

    public function carousel()
    {
        $content = Carousel::all();
        $ct_count = $content->count();
        $content = $content->sortBy('id', SORT_NATURAL);
        $types= Type::all();
        $categories= Category::all();
        $subtitle = 'All/Carousel';

        return view('admin.carousel',[
            'title'=>'Admin | Portal Film',
            'subtitle'=>$subtitle,
            'content'=>$content,
            'types'=>$types,
            'categories'=>$categories,
            'ct_count'=>$ct_count
        ]);
    }

    public function store_carousel(Request $request){
        $request->validate(([
            'title'=>'required',
            'caption'=>'required',
            'image'=>'required|image'
        ]));

        $newCarousel = new Carousel();
        $newCarousel->title = $request->input('title');
        $newCarousel->caption = $request->input('caption');
        $newCarousel->movie_id = 1;
        $image = $request->image->store('carousel');
        $newCarousel->imagePath = $image;
        $newCarousel->save();

        return redirect()->route('carousel')->withSuccess('Successfully added new content!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'year'=>'required',
            'synopsis'=>'required',
            'price'=>'required',
            'type'=>'required',
            'url'=>'required|url',
            'poster'=>'required|image',
            'backdrop'=>'required|image'
        ]);


        if(!empty($request->category)){
            $poster = $request->poster->store('posters');
            $backdrop = $request->backdrop->store('backdrop');

            $newContent = new Movie();
            $newContent->title = $request->input('title');
            $newContent->year = $request->input('year');
            $newContent->synopsis = $request->input('synopsis');
            $newContent->price = $request->input('price');
            $newContent->type_id = $request->input('type');
            $newContent->url = $request->input('url');
            $newContent->poster = $poster;
            $newContent->backdrop = $backdrop;
            $newContent->save();

            $latest_id = Movie::orderBy('id', 'desc')->first();
            $category = $request->category;

            foreach ($category as $ctg){
                $content_category = new Movie_Category();
                $content_category->movie_id = $latest_id->id;
                $content_category->category_id = $ctg;
                $content_category->save();
            }

            return redirect()->route('admin.home')->withSuccess('Successfully added a movie!');
        }else{
            return back()->withErrors('You need to select at least 1 category!');
        }
    }

    public function show_carousel($id){
        $content = Carousel::find($id);
        $types= Type::all();
        $categories= Category::all();

        return view('admin.edit-carousel', [
            'content'=>$content,
            'types'=>$types,
            'categories'=>$categories,
        ]);
    }

    public function edit_carousel($id, Request $request){
        $request->validate(([
            'title'=>'required',
            'caption'=>'required',
            'image'=>'image'
        ]));

        $newCarousel = Carousel::find($id);
        $newCarousel->title = $request->input('title');
        $newCarousel->caption = $request->input('caption');

        if($request->hasFile('image')){
            $dir = 'storage/'.$newCarousel->imagePath;
            File::delete($dir);
            $image = $request->image->store('carousel');
            $newCarousel->imagePath = $image;
        }

        $newCarousel->save();

        return redirect()->route('carousel')->withSuccess('Successfully edited content!');
        return redirect()->route('carousel')->withSuccess('Successfully edited content!');
    }

    public function show($id)
    {
       $content = Movie::find($id);
       $ctg_list = $content->category;
       $category=[];
       foreach ($ctg_list as $ctg){
           array_push($category, $ctg->id);
       }

        $types= Type::all();
        $categories= Category::all();
       return view('admin.edit-content', [
           'content'=>$content,
           'types'=>$types,
           'categories'=>$categories,
           'category'=>$category,
       ]);

    }


    public function edit($id, Request $request)
    {
        $request->validate([
            'title'=>'required',
            'year'=>'required',
            'synopsis'=>'required',
            'price'=>'required',
            'type'=>'required',
            'url'=>'required|url',
            'poster'=>'image',
            'backdrop'=>'image'
        ]);

        if(!empty($request->category)){
            $content = Movie::find($id);
            $content->title = $request->input('title');
            $content->year = $request->input('year');
            $content->synopsis = $request->input('synopsis');
            $content->price = $request->input('price');
            $content->type_id = $request->input('type');
            $content->url = $request->input('url');

            if($request->hasFile('poster')){
                $dir = 'storage/'.$content->poster;
                File::delete($dir);
                $poster =$request->poster->store('posters');
                $content->poster = $poster;
            }

            if($request->hasFile('backdrop')){
                $dir = 'storage/'.$content->backdrop;
                File::delete($dir);
                $backdrop =$request->backdrop->store('backdrop');
                $content->backdrop = $backdrop;
            }

            $content->save();

            Movie_Category::where('movie_id', $id)->delete();
            $category = $request->category;

            foreach ($category as $ctg){
                $content_category = new Movie_Category();
                $content_category->movie_id = $id;
                $content_category->category_id = $ctg;
                $content_category->save();
            }


            return redirect()->route('admin.home')->withSuccess('Successfully edited a movie!');
        }else{
            return back()->withErrors('You need to select at least 1 category!');
        }

    }

    public function delete($id){
        $movie = Movie::find($id);
        $poster = 'storage/'.$movie->poster;
        $backdrop = 'storage/'.$movie->backdrop;
        File::delete($poster);
        File::delete($backdrop);
        $movie->delete();

        return redirect()->route('admin.home')->withSuccess('Successfully deleted a movie!');
    }

    public function delete_carousel($id){
        $carousel = Carousel::find($id);
        $image = 'storage/'.$carousel->imagePath;
        File::delete($image);
        $carousel->delete();

        return redirect()->route('carousel')->withSuccess('Successfully deleted a content!');
    }


    public function login(Request $request){
        $credential = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $remember = $request->has('remember');

        if(!Auth::attempt($credential,$remember)){
            return redirect()->back()->withErrors('Invalid email or password');
        }

        $user = Auth::user();
        if(!strcmp($user->role, 'Member'))
            return redirect()->route('home');
        elseif (!strcmp($user->role, 'Admin'))
            return redirect()->route('admin.home');

    }


    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|max:20',
            'confirm'=>'required|same:password',
            'terms'=> 'required'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = 'Member';
        $user->save();

        return redirect()->route('index_login');
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('home');
    }

    public function edit_password(Request $request){
        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            return redirect()->back()->withErrors("Your current password does not matches with the password.");
        }
        if(strcmp($request->get('password'), $request->get('new-password')) == 0){
            return redirect()->back()->withErrors("New Password cannot be same as your current password.");
        }

        $request->validate([
            'password' => 'required',
            'new-password'=>'required|min:8|max:20',
            'confirm'=>'required|same:new-password',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->get('new-password'));
        $user->save();

        return redirect()->route('profile')->withSuccess('Successfully changed your password!');
    }
}
