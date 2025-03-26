<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;
use App\Models\Book;
use App\Models\ElectronicBook;
use App\Models\PhysicalBook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;


// controllers :

use App\Http\Controllers\Seller\DigitalBookController as SellerDigitalBookController;
use App\Http\Controllers\Seller\MarketplaceBookController as SellerMarketplaceBookController;




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







// seller -------------------- :


Route::prefix('seller')->as('seller.')->group(function () {

    Route::resource('books', SellerDigitalBookController::class);

    // Route::get('books/create', [SellerDigitalBookController::class, 'create'])->name('seller.books.create');

    // Route::post('books', [SellerDigitalBookController::class, 'store'])->name('seller.books.store');

    // Route::get('books/{book}', [SellerDigitalBookController::class, 'show'])->name('seller.books.show');

    // Route::get('books/{book}/edit', [SellerDigitalBookController::class, 'edit'])->name('seller.books.edit');

    // Route::put('books/{book}', [SellerDigitalBookController::class, 'update'])->name('seller.books.update');

    // Route::delete('books/{book}', [SellerDigitalBookController::class, 'destroy'])->name('seller.books.destroy');



    Route::resource('marketplace/books', SellerMarketplaceBookController::class)->names('marketplace.books');


});






// Route::get('/seller/books/create', function () {


//     return view('seller.books.digital.create');

// });


// Route::get('/seller/books/{id}', function ($id) {

//     $electronicBook = ElectronicBook::findOrFail($id);

//     return view('seller.books.digital.view', compact('electronicBook'));

// })->name('home');




// Route::get('/seller/marketplace', function () {

//     $physicalBooks = PhysicalBook::paginate(2);


//     return view('seller.books.physical.index', compact('physicalBooks'));

// })->name('home');


// Route::get('/seller/marketplace/create', function () {


//     return view('seller.books.physical.create');

// });

// Route::get('/seller/marketplace/{id}', function ($id) {

//     $physicalBook = PhysicalBook::findOrFail($id);

//     return view('seller.books.physical.view', compact('physicalBook'));

// })->name('home');




// // edit update show form
// Route::get('/seller/books/{id}/edit', function ($id) {

//     $electronicBook = ElectronicBook::findOrFail($id);

//     return view('seller.books.digital.edit', compact('electronicBook'));

// });






// // edit update show form
// Route::get('/seller/marketplace/{id}/edit', function ($id) {

//     $physicalBook = PhysicalBook::findOrFail($id);

//     return view('seller.books.physical.edit', compact('physicalBook'));

// });




























// Route::get('home', function () {
//     return view('pages.home');
// })->name('home');


// Route::get('user', function () {
//     dd(Auth::user());
// });

// Route::get('email', function () {
//     return view('auth.verify-email');

// });



// Route::get('books', function () {
//     return view('pages.products.index');
// })->name('home');



// Route::get('single/books', function () {
//     return view('pages.products.single');
// })->name('home');



// Route::get('checkout', function () {
//     return view('pages.products.checkout');
// })->name('home');



// Route::get('marketplace', function () {
//     return view('pages.marketplace.index');
// })->name('home');


// Route::get('marketplace/single', function () {
//     return view('pages.marketplace.single');
// })->name('home');



// Route::get('/chat', function () {
//     return view('pages.messages');
// })->name('home');



// Route::get('profile', function () {
//     return view('pages.profile');
// })->name('home');


// Route::get('posts', function () {
//     return view('pages.posts');
// })->name('home');




// Route::get('admin/dashboard', function () {
//     return view('admin.dashboard');
// })->name('home');



// Route::get('/admin/users', function () {

//     $users = User::paginate(5);

//     return view('admin.users.index', compact('users'));
//     // return view('admin.users.index');
// })->name('home');


// Route::get('/admin/marketplace', function () {

//     $physicalBooks = PhysicalBook::paginate(2);

//     // $physicalBooks = PhysicalBook::all();

//     return view('admin.books.physical.index', compact('physicalBooks'));

// })->name('home');


// Route::get('/admin/marketplace/{id}', function ($id) {

//     $physicalBook = PhysicalBook::findOrFail($id);

//     return view('admin.books.physical.view', compact('physicalBook'));

// })->name('home');



// Route::get('/admin/books', function () {

//     $electronicBooks = ElectronicBook::paginate(2);

//     // $electronicBooks = ElectronicBook::all();

//     return view('admin.books.digital.index', compact('electronicBooks'));

// })->name('home');


// Route::get('/admin/books/{id}', function ($id) {

//     $electronicBook = ElectronicBook::findOrFail($id);

//     return view('admin.books.digital.view', compact('electronicBook'));

// })->name('home');





// Route::get('/admin/orders', function () {
//     return view('admin.order.index');
// })->name('home');






















