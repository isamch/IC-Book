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
// admin:
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DigitalBookController as AdminDigitalBookController;
use App\Http\Controllers\Admin\MarketplaceBookController as AdminMarketplaceBookController;


// seller :
use App\Http\Controllers\Seller\DigitalBookController as SellerDigitalBookController;
use App\Http\Controllers\Seller\MarketplaceBookController as SellerMarketplaceBookController;


// buyer :
use App\Http\Controllers\Buyer\ProfileController as BuyerProfileController;
use App\Http\Controllers\Buyer\HomeController as BuyerHomeController;
use App\Http\Controllers\Buyer\DigitalBookController as BuyerDigitalBookController;
use App\Http\Controllers\Buyer\MarketplaceBookController as BuyerMarketplaceBookController;
use App\Http\Controllers\Buyer\PostsController as BuyePostController;
use App\Http\Controllers\Chat\ChatController;

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


Route::get('/', [BuyerHomeController::class, 'index'])->name('home');


// auth :
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'showloginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');




// email verification :
Route::prefix('email')->group(function () {
    Route::get('verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('resend', [VerificationController::class, 'send'])->name('verification.send');
});

Route::get('email/message', [VerificationController::class, 'ShowMessage'])->name('verification.notice');






// admin -------------------- :

Route::middleware(['auth', 'email.verified'])->prefix('admin')->as('admin.')->group(function () {

    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('users/{id}', [AdminUserController::class, 'show'])->name('users.show');
    Route::patch('users/{id}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');


    Route::resource('books', AdminDigitalBookController::class);
    Route::patch('books/{id}/toggle-status', [AdminDigitalBookController::class, 'toggleStatus'])->name('books.toggle-status');


    Route::resource('marketplace/books', AdminMarketplaceBookController::class)->names('marketplace.books');
    Route::patch('marketplace/books/{id}/toggle-status', [AdminMarketplaceBookController::class, 'toggleStatus'])->name('marketplace.books.toggle-status');
});






// seller -------------------- :
Route::middleware(['auth', 'email.verified'])->prefix('seller')->as('seller.')->group(function () {
    Route::resource('books', SellerDigitalBookController::class);

    Route::resource('marketplace/books', SellerMarketplaceBookController::class)->names('marketplace.books');
});



// buyer -------------------- :
Route::middleware(['auth', 'email.verified'])->name('buyer.')->group(function () {

    Route::get('profile/{id}', [BuyerProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/{id}/edit', [BuyerProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/{id}', [BuyerProfileController::class, 'update'])->name('profile.update');


    Route::get('home', [BuyerHomeController::class, 'index'])->name('home');


    Route::prefix('books')->group(function () {
        Route::get('/', [BuyerDigitalBookController::class, 'index'])->name('books.index');
        Route::get('/load-more/{offset}', [BuyerDigitalBookController::class, 'loadMore'])->name('books.loadMore');
        Route::get('/filter', [BuyerDigitalBookController::class, 'applyFilter'])->name('books.applyFilter');

        Route::get('/{id}', [BuyerDigitalBookController::class, 'show'])->name('books.show');

        Route::post('/{id}/reviews/create', [BuyerDigitalBookController::class, 'createReview'])->name('books.review.create');
    });


    Route::prefix('marketplace/books')->group(function () {

        Route::get('/', [BuyerMarketplaceBookController::class, 'index'])->name('marketplace.books.index');
        Route::get('/load-more/{offset}', [BuyerMarketplaceBookController::class, 'loadMore'])->name('marketplace.books.loadMore');
        Route::get('/filter', [BuyerMarketplaceBookController::class, 'applyFilter'])->name('marketplace.books.applyFilter');

        Route::get('/{id}', [BuyerMarketplaceBookController::class, 'show'])->name('marketplace.books.show');
    });



    Route::prefix('posts')->group(function () {

        Route::get('/', [BuyePostController::class, 'index'])->name('posts.index');

        Route::get('/load-more/{offset}', [BuyePostController::class, 'loadMore']);

        Route::post('/', [BuyePostController::class, 'storePost'])->name('posts.store');


        Route::post('/{post}/like', [BuyePostController::class, 'toggleLike'])->name('posts.likes');

        Route::post('/{post}/comment/create', [BuyePostController::class, 'addComment'])->name('posts.comments');
    });



    Route::prefix('chat')->group(function () {

        Route::get('/', [ChatController::class, 'index'])->name('chat');
        Route::get('/{id}', [ChatController::class, 'getConversation'])->name('chat.conversation');

        Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('chat.message.send');

        Route::post('/mark-as-read', [ChatController::class, 'markAsRead'])->name('chat.markAsRead');
    });
});







Route::get('/test/chat', function () {
    return view('buyer.chat.testChat');
});
