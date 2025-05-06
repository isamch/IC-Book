<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sellerRole = Role::where('name', 'seller')->first();
        $users_seller = $sellerRole->users;

        foreach ($users_seller as $user_seller) {
            Seller::create([
                'user_id' => $user_seller->id,
            ]);
        }
    }
}
