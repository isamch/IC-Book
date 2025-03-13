<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthService
{
    protected $UserRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    public function register(array $data)
    {

        $data['password'] = Hash::make($data['password']);


        if (isset($data['photo'])) {

            $path = 'images/profile/seller';

            if ($data['user_type'] === 'buyer' ) {
                $path = 'images/profile/buyer';
            }

            $data['photo'] = $data['photo']->store($path, 'public');


        } else {
            $data['photo'] = 'images/profile/default/default-profile.png';
        }


        return $this->UserRepository->create($data);
    }



    public function login(array $credentials)
    {


    }


    public function logout()
    {
        Auth::logout();
    }
}
