<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Buyer;
use App\Models\Role;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AssignBuyerRoleToAdminsAndSellersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $buyerRole = Role::where('name', 'buyer')->first();

        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'seller']);
        })->get();

        foreach ($users as $user) {
            $user->roles()->syncWithoutDetaching([$buyerRole->id]);
        }


    }
}
