<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use App\Models\Movie_Category;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

            return redirect()->route('admin.home');
        }else{
            return back()->withErrors('You need to select at least 1 category!');
        }
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


            return redirect()->route('admin.home');
        }else{
            return back()->withErrors('You need to select at least 1 category!');
        }

    }


    public function login(Request $request){
        $credential = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if(!Auth::attempt($credential,$request->input('remember'))){
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
