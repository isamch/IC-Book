<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ConvertSellersAndAdminsToBuyersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminAndSellerIds = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'seller']);
        })
        ->pluck('id')
        ->toArray();

        foreach ($adminAndSellerIds as $userId) {
            Buyer::firstOrCreate(['user_id' => $userId]);
        }


    }
}
