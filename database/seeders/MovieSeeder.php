<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Movie::query()->insert([
            [
                'type_id'=>1,
                'title'=>'Avengers Endgame',
                'synopsis'=>'This is a synopsis',
                'imagePath'=>'/posters/Avengers Endgame.jpg',
                'year'=>2019,
                'price'=>'49.000'
            ],
            [
                'type_id'=>1,
                'title'=>'John Wick 3: Parabellum',
                'synopsis'=>'This is a synopsis',
                'imagePath'=>'/posters/John Wick Parabellum.jpg',
                'year'=>2019,
                'price'=>'39.000'
            ]
        ]);
    }
}
