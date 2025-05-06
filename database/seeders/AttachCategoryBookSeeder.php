<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttachCategoryBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $books = Book::all();

        foreach ($books as $book) {

            $book->categories()->attach(Category::inRandomOrder()->take(2)->pluck('id'));

        }





    }
}
