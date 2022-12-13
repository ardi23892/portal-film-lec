<?php

namespace Database\Seeders;

use App\Models\Movie_Category;
use Illuminate\Database\Seeder;

class MovieCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Movie_Category::query()->insert([
            [
                'movie_id'=>1,
                'category_id'=>1
            ],
            [
                'movie_id'=>2,
                'category_id'=>1
            ]
        ]);
    }
}
