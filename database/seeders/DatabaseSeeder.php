<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Win Win Maw",
            'role'=> "admin",
            'email' => "admin@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('asdffdsa'),
            'remember_token' => Str::random(10),
        ]);

        // \App\Models\User::factory(10)->create();
        User::factory(10)->create();
        Category::factory(5)->create();
        Post::factory(20)->create();
        Tag::factory(5)->create();


//        Photo::create([
//            'name'=>"asdf",
//            'user_id'=>1,
//            'post_id'=>1
//        ]);
//
//        Photo::create([
//            'name'=>"asdf",
//            'user_id'=>1,
//            'post_id'=>1
//        ]);

//        foreach(Post::all() as $post){
//
//        }

        Post::all()->each(function ($post){
            $tagIds = Tag::inRandomOrder()->limit(rand(1,3))->get()->pluck('id');
           $post->tags()->attach($tagIds);
        });

    }
}
