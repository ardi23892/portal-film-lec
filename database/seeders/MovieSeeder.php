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
                'poster'=>'/posters/Avengers Endgame.jpg',
                'backdrop'=>'/backdrop/Avengers Endgame.png',
                'year'=>2019,
                'price'=>49000
            ],
            [
                'type_id'=>1,
                'title'=>'John Wick 3: Parabellum',
                'synopsis'=>'This is a synopsis',
                'poster'=>'/posters/John Wick Parabellum.jpg',
                'backdrop'=>'/backdrop/John Wick Parabellum.jpg',
                'year'=>2019,
                'price'=>39000
            ]
        ]);
    }
}
