<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('posts')->insert or if we wanna use the model
       Post::create(
            [
                /* 'name'=> Str::random(6),
                'email'=>Str::random(6),'@gmail.com',
                 'password'=>Hash::make('12345678')*/
                 'title' => 'seed محاضرة تعليم',
                 'description' => 'database على seed محاضرة لفهم كل خطوات',
                 /*this is foreign key with a limit range*/
                 'user_id' => 1,
            ],
            [
                 'title' => 'seed محاضرة تعليم',
                 'description' => 'database على seed محاضرة لفهم كل خطوات',
                 'user_id' => 2,
            ],
            [
                'title' => 'seed محاضرة تعليم',
                'description' => 'database على seed محاضرة لفهم كل خطوات',
                'user_id' => 3,
            ],
            [
                'title' => 'seed محاضرة تعليم',
                'description' => 'database على seed محاضرة لفهم كل خطوات',
                'user_id' => 4,
            ]
            );
    }
}
