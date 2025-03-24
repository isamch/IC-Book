<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();
        // $posts = Post::all();
        $users = User::all();

        for ($i = 1; $i <= 20; $i++) {

            Comment::create([
                'content' => $faker->sentence(5),
                'user_id' => $users->random()->id,
                'post_id' => $faker->numberBetween(1, 15),
            ]);

        }
    }
}
