<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Exception;
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


        try {

            $data = $request->only('photo', 'user_type', 'first_name', 'last_name', 'email', 'password', 'birthdate');

            $user = $this->authService->register($data);

            if (!$user) {
                throw new Exception('An error occurred during registration. Please try again.');
            }



            return redirect()->route('login.form')->with('success', 'Account created successfully! Pleas Check Your email');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }


    // login :
    public function showLoginForm()
    {
        return view('Auth.login');
    }


    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            $user = $this->authService->login($credentials);
            $request->session()->regenerate();

            return redirect()->route('home')->with('success', 'Login Success!');
        } catch (\Illuminate\Auth\AuthenticationException $e) {

            return redirect()->back()->withInput()->withErrors(['login' => $e->getMessage()]);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()->route('verification.notice')->with([
                'message' => 'It seems that you have not verified your email address yet. Please check your inbox for the verification link!',
            ]);
        }
        //  catch (\Exception $e) {

        //     return redirect()->back()->withInput()->withErrors(['login' => 'An unexpected error occurred. Please try again.']);

        // }
    }


    public function logout(Request $request)
    {
        $this->authService->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
