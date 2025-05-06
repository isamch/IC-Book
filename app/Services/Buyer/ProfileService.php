<?php

namespace App\Services\Buyer;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileService
{


    public function getUserProfile(int $id)
    {
        return User::where('id', $id)
            ->where('status', 1)
            ->whereNotNull('email_verified_at')
            ->firstOrFail();
    }


    public function updateUserProfile(Request $request, User $user)
    {

        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'gender' => 'required|in:m,f',
            'about_me' => 'nullable|string|max:500',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|regex:/^[0-9+\-()\s]+$/|max:20|unique:users,phone,' . $user->id,
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->email !== $user->email) {
            $user->forceFill(['email_verified_at' => null])->save();
        }

        $user->update(
            $request->only([
                'first_name',
                'last_name',
                'gender',
                'about_me',
                'email',
                'phone',
                'address',
            ])
        );

        if ($request->hasFile('photo')) {

            $photoPath = 'images/profile/seller';
            if ($user->roles->pluck('name')->first() === 'buyer') {
                $photoPath = 'images/profile/buyer';
            } elseif ($user->roles->pluck('name')->first() === 'admin') {
                $photoPath = 'images/profile/admin';
            }

            $photoPath = $request->file('photo')->store($photoPath, 'public');

            $user->update(['photo' => $photoPath]);
        }


        return $user;
    }
}
