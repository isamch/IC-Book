<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // */
        // protected $fillable = [
        //     'first_name',
        //     'last_name',
        //     'email',
        //     'password',
        //     'photo',
        //     'age',
        //     'verification_token',
        //     'birthdate',
        //     'status'
        // ];

        foreach (range(1, 10) as $index) {

            $age = $faker->numberBetween(18, 65);

            $birthdate = now()->subYears($age)->format('Y-m-d');

            $user = User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // password
                'photo' => "images/profile/default/default-profile.png",
                'age' => $age,
                'status' => 1,
                'birthdate' => $birthdate,
            ]);

            $role = Role::inRandomOrder()->first();
            $user->roles()->attach($role);

        }



    }
}
