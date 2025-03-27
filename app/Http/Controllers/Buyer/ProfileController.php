<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('buyer.profile.view', compact('user'));
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('buyer.profile.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);



        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'gender' => 'required|in:m,f',
            'about_me' => 'nullable|string|max:500',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|regex:/^[0-9+\-()\s]+$/|max:20',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

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





        return redirect()->route('seller.profile.view', $id)->with('success', 'Profile updated successfully.');

    }




}
