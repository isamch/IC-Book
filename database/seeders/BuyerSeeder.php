<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buyerRole = Role::where('name', 'buyer')->first();
        $users_buyer = $buyerRole->users;

        foreach ($users_buyer as $user_buyer) {
            Buyer::create([
                'user_id' => $user_buyer->id,
            ]);
        }
    }
}
