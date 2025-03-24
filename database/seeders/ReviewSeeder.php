<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\ElectronicBook;
use App\Models\Buyer;
use Faker\Factory as Faker;


class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Review::create([
                'rating' => $faker->numberBetween(1, 5),
                'comment' => $faker->sentence,
                'electronic_book_id' => ElectronicBook::all()->random()->id,

                'buyer_id' => Buyer::all()->random()->id,

            ]);
        }

    }
}
