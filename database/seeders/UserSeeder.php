<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::query()->insert([
            [
                'name'=>'Agustinus',
                'email'=>'a@a.com',
                'password'=>'abcde',
                'role'=>'Admin'

            ],
//            [
//                'name'=>'Ardian',
//                'email'=>'b@b.com',
//                'password'=>'abcde',
//                'role'=>'Member'
//            ],
//            [
//                'name'=>'Cakra',
//                'email'=>'c@c.com',
//                'password'=>'abcde',
//                'role'=>'Member'
//            ]
        ]);
    }
}
