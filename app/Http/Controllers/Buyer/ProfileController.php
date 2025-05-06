<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Buyer\ProfileService as BuyerProfileService;
use Illuminate\Http\Request;
class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(BuyerProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function show($id)
    {
        $user = $this->profileService->getUserProfile($id);
        return view('buyer.profile.view', compact('user'));
    }


    public function edit($id)
    {
        $user = $this->profileService->getUserProfile($id);
        try {
            $this->authorize('update', $user);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            return redirect()->back()->withErrors(['You are not authorized to edit this user.']);
        }

        return view('buyer.profile.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {

        $user = $this->profileService->getUserProfile($id);

        try {

            $this->authorize('update', $user);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {

            return redirect()->back()->withErrors(['You are not authorized to update this user.']);
        }

        $user = $this->profileService->updateUserProfile($request, $user);


        return redirect()->route('buyer.profile.show', $id)->with('success', 'Profile updated successfully.');

    }




}
