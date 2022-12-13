<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function carousel(){
        return $this->hasOne(Carousel::class);
    }

    public function category(){
        return $this->belongsToMany(Category::class, 'movie_categories');
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function rent(){
        return $this->belongsToMany(User::class, 'rents');
    }

    public function watchlist()
    {
        return $this->belongsToMany(User::class, 'watchlists');
    }

    public function review(){
        return $this->belongsToMany(User::class, 'reviews');
    }
}
