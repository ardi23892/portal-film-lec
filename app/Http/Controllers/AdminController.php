<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use App\Models\Type;
use Illuminate\Http\Request;

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
            'poster'=>'required|mimes:jpg,jpeg,png',
            'backdrop'=>'required|mimes:jpg,jpeg,png'
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
