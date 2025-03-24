<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});




// auth :
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'showloginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('logout', [AuthController::class, 'logout'])->name('logout');



// email verification :
Route::prefix('email')->group(function () {
    Route::get('verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('resend', [VerificationController::class, 'send'])->name('verification.send');
});

Route::get('email/message', [VerificationController::class, 'ShowMessage'])->name('verification.notice');




Route::get('home', function () {
    return view('pages.home');
})->name('home');


Route::get('user', function () {
    dd(Auth::user());
});

Route::get('email', function () {
    return view('auth.verify-email');

});



Route::get('books', function () {
    return view('pages.products.index');
})->name('home');



Route::get('single/books', function () {
    return view('pages.products.single');
})->name('home');



Route::get('checkout', function () {
    return view('pages.products.checkout');
})->name('home');



Route::get('marketplace', function () {
    return view('pages.marketplace.index');
})->name('home');


Route::get('marketplace/single', function () {
    return view('pages.marketplace.single');
})->name('home');



Route::get('/chat', function () {
    return view('pages.messages');
})->name('home');



Route::get('profile', function () {
    return view('pages.profile');
})->name('home');


Route::get('posts', function () {
    return view('pages.posts');
})->name('home');




Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->name('home');



Route::get('/admin/users', function () {

    $users = User::paginate(5);

    return view('admin.users.index', compact('users'));
    // return view('admin.users.index');
})->name('home');


Route::get('/admin/book', function () {
    return view('admin.books.digital.index');
})->name('home');

Route::get('/admin/marketplace', function () {
    return view('admin.books.physical.index');
})->name('home');


Route::get('/admin/orders', function () {
    return view('admin.order.index');
})->name('home');
