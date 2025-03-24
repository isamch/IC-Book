<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Seller;
use App\Models\Category;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {

            $book = Book::create([
                'title' => $faker->sentence(3),
                'author' => $faker->name,
                'description' => $faker->text,
                'price' => $faker->randomFloat(2, 5, 100),
                'seller_id' => Seller::all()->random()->id,
            ]);

            $book->categories()->attach(Category::inRandomOrder()->take(2)->pluck('id'));

                $book->images()->create([
                    'image' => "images/books/digitale/book (1).jpeg"
                ]);

                $book->images()->create([
                    'image' => "images/books/digitale/book (1).jpg"
                ]);

                $book->images()->create([
                    'image' => "images/books/digitale/book (2).jpg"
                ]);

        }

    }
}
