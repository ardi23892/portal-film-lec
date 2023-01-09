<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\User;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{


    public function addToWatchList($id){

        $watchlists = Watchlist::where('user_id','=',Auth::user()->id)->get();
        // dd($watchlists);

        foreach ($watchlists as $list) {
            // dd($list);
            if($list->movie_id == $id){
                $list->delete();
                return redirect()->route('detail', ['id'=>$id])->with('alert','Movie removed from watchlist');
            }
        }
        $watchlist = new Watchlist();
        $watchlist->user_id = Auth::user()->id;
        $watchlist->movie_id = $id;
        $watchlist->save();

        return redirect()->route('detail', ['id'=>$id])->with('alert','Movie added to watchlist');
    }

    public function rentMovie($id){
        $rent = new Rent();
        $rent->user_id = Auth::id();
        $rent->movie_id = $id;
        $rent->save();

        return redirect()->route('detail', ['id'=>$id])->with('alert','Successfully purchased a movie!');
    }

}
