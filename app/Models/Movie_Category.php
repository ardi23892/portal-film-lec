<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table='movie_categories';

    public function movie(){
        return $this->belongsTo(Movie::class,'movie_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
