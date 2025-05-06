<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::all();


        foreach ($users as $user) {
            Post::create([
                'content' => $faker->sentence(10),
                'photo' => "images/posts/post.jpg",
                'user_id' => $user->id,
            ]);
        }

        for ($i=1; $i <= 5; $i++) {

            Post::create([
                'content' => $faker->sentence(10),
                'photo' => "images/posts/post.avif",
                'user_id' => $i,
            ]);

        }
    }
}
