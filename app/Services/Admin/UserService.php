<?php

namespace App\Services\Admin;

use App\Models\User;

class UserService
{

    public function getAllUsers()
    {
        return User::orderBy('created_at', 'desc')->paginate(5);
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }


    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        $user->status = !$user->status;

        $user->save();

        return $user;
    }
}
