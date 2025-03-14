<?php

namespace App\Services;

use App\Repositories\BuyerRepository;
use App\Repositories\SellerRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;



class AuthService
{
    protected $UserRepository;
    protected $sellerRepository;
    protected $buyerRepository;

    public function __construct(UserRepository $UserRepository, SellerRepository $sellerRepository, BuyerRepository $buyerRepository)
    {
        $this->UserRepository = $UserRepository;
        $this->sellerRepository = $sellerRepository;
        $this->buyerRepository = $buyerRepository;
    }

    public function register(array $data)
    {
        if ($data['user_type'] === 'buyer') {
            return $this->registerBuyer($data);
        } elseif ($data['user_type'] === 'seller') {
            return $this->registerSeller($data);
        } elseif ($data['user_type'] === 'admin') {
            return $this->registerUser($data);
        }
    }

    public function registerUser(array $data)
    {
        if (isset($data['photo'])) {
            $path = 'images/profile/seller';
            if ($data['user_type'] === 'buyer') {
                $path = 'images/profile/buyer';
            } elseif ($data['user_type'] === 'admin') {
                $path = 'images/profile/admin';
            }

            $data['photo'] = $data['photo']->store($path, 'public');
        }

        $data['password'] = Hash::make($data['password']);

        return $this->UserRepository->create($data);
    }

    public function registerBuyer(array $data)
    {
        $user = $this->registerUser($data);
        $this->buyerRepository->create(['user_id' => $user->id]);
        return $user;
    }

    public function registerSeller(array $data)
    {
        $user = $this->registerUser($data);
        $this->sellerRepository->create(['user_id' => $user->id]);
        return $user;
    }



    public function login(array $credentials)
    {

        if (!Auth::attempt($credentials)) {
            throw new AuthenticationException('The provided email or password is incorrect. Please try again.');
        }

        if (!Auth::user()->email_verified_at) {
            throw new Exception('Please verify your email address to continue.');
        }

        request()->session()->regenerate();
        return Auth::user();
    }


    public function logout()
    {
        Auth::logout();
    }
}
