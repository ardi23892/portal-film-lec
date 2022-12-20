<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use App\Models\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'year'=>'required',
            'synopsis'=>'required',
            'price'=>'required',
            'type'=>'required',
            'poster'=>'required|image',
            'backdrop'=>'required|image'
        ]);

        $poster = $request->poster->store('posters');
        $backdrop = $request->backdrop->store('backdrop');

        $newContent = new Movie();
        $newContent->title = $request->input('title');
        $newContent->year = $request->input('year');
        $newContent->synopsis = $request->input('synopsis');
        $newContent->price = $request->input('price');
        $newContent->type_id = $request->input('type');
        $newContent->poster = $poster;
        $newContent->backdrop = $backdrop;
        $newContent->save();

        return redirect()->route('admin.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $content = Movie::find($id);
        $types= Type::all();
        $categories= Category::all();
       return view('admin.edit-content', [
           'content'=>$content,
           'types'=>$types,
           'categories'=>$categories
       ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $request->validate([
            'title'=>'required',
            'year'=>'required',
            'synopsis'=>'required',
            'price'=>'required',
            'type'=>'required',
            'poster'=>'image',
            'backdrop'=>'image'
        ]);

        $content = Movie::find($id);
        $content->title = $request->input('title');
        $content->year = $request->input('year');
        $content->synopsis = $request->input('synopsis');
        $content->price = $request->input('price');
        $content->type_id = $request->input('type');

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

        return redirect()->route('admin.home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
