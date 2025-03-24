<?php

namespace Database\Seeders;

use App\Models\PhysicalBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhysicalBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 6; $i <= 10; $i++) {
            PhysicalBook::create([
                'location' => "marackech, giliz",
                'book_id' => $i,
            ]);
        }
    }
}
