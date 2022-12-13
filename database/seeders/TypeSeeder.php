<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Type::query()->insert([
            ['name'=>'Movie'],
            ['name'=>'Series'],
            ['name'=>'Anime']
        ]);
    }
}
