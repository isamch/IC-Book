<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{


    public function all()
    {
        return User::all();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function findByEmail(array $data)
    {
        return User::create($data);
    }


}
