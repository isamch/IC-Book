<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ElectronicBook;
use App\Models\Book;


class ElectronicBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i <= 5; $i++) {
            ElectronicBook::create([
                'file' => "file/books/pdf/Laravel-Events-Broadcasting-and-Reverb.pdf",
                'book_id' => $i,
            ]);
        }
    }
}
