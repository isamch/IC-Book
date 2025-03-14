<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    // register :
    public function showRegistrationForm()
    {
        return view('Auth.register');
    }


    public function register(RegisterRequest $request)
    {


        $data = $request->only('photo', 'user_type', 'first_name', 'last_name', 'email', 'password', 'birthdate', 'user_type');

        $user = $this->authService->register($data);
        if (!$user) {
            dd($user);
        }

        return redirect()->route('login.form')->with('success_register', 'account created successfully');
    }


    // login :
    public function showLoginForm()
    {
        return view('Auth.login');
    }


    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $user = $this->authService->login($credentials);

        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Login Success!');

    }



    public function logout(Request $request) {
        $this->authService->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
