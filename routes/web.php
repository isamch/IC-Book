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
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DigitalBookController as AdminDigitalBookController;
use App\Http\Controllers\Admin\MarketplaceBookController as AdminMarketplaceBookController;


// seller :
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Seller\DigitalBookController as SellerDigitalBookController;
use App\Http\Controllers\Seller\MarketplaceBookController as SellerMarketplaceBookController;


// buyer :
use App\Http\Controllers\Buyer\ProfileController as BuyerProfileController;
use App\Http\Controllers\Buyer\HomeController as BuyerHomeController;
use App\Http\Controllers\Buyer\DigitalBookController as BuyerDigitalBookController;
use App\Http\Controllers\Buyer\MarketplaceBookController as BuyerMarketplaceBookController;
use App\Http\Controllers\Buyer\PostsController as BuyePostController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Buyer\StripeController;

use App\Http\Controllers\Buyer\OrderController as BuyerOrderController;

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


Route::get('/', [BuyerHomeController::class, 'index'])->name('buyer.home');
Route::get('home', [BuyerHomeController::class, 'index'])->name('buyer.home');


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

Route::middleware(['auth', 'email.verified', 'role.check:admin'])->prefix('admin')->as('admin.')->group(function () {

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('users/{id}', [AdminUserController::class, 'show'])->name('users.show');
    Route::patch('users/{id}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');


    Route::resource('books', AdminDigitalBookController::class);
    Route::patch('books/{id}/toggle-status', [AdminDigitalBookController::class, 'toggleStatus'])->name('books.toggle-status');


    Route::resource('marketplace/books', AdminMarketplaceBookController::class)->names('marketplace.books');
    Route::patch('marketplace/books/{id}/toggle-status', [AdminMarketplaceBookController::class, 'toggleStatus'])->name('marketplace.books.toggle-status');
});






// seller -------------------- :
Route::middleware(['auth', 'email.verified', 'role.check:seller'])->prefix('seller')->as('seller.')->group(function () {

    Route::get('dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');

    Route::resource('books', SellerDigitalBookController::class);

    Route::resource('marketplace/books', SellerMarketplaceBookController::class)->names('marketplace.books');
});



// buyer -------------------- :
Route::middleware(['auth', 'email.verified', 'role.check:buyer'])->name('buyer.')->group(function () {


    Route::prefix('profile')->as('profile.')->group(function(){

        Route::get('/{id}', [BuyerProfileController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [BuyerProfileController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BuyerProfileController::class, 'update'])->name('update');

    });



    Route::prefix('books')->as('books.')->group(function () {
        Route::get('/', [BuyerDigitalBookController::class, 'index'])->name('index');
        Route::get('/load-more/{offset}', [BuyerDigitalBookController::class, 'loadMore'])->name('loadMore');
        Route::get('/filter', [BuyerDigitalBookController::class, 'applyFilter'])->name('applyFilter');

        Route::get('/orders', [BuyerOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{id}', [BuyerOrderController::class, 'show'])->name('orders.show');

        // preview pdf:
        Route::get('/{id}/preview', [BuyerOrderController::class, 'preview'])->name('preview.pdf');

        Route::get('/{id}', [BuyerDigitalBookController::class, 'show'])->name('show');
        Route::post('/{id}/reviews/create', [BuyerDigitalBookController::class, 'createReview'])->name('review.create');



    });


    Route::prefix('marketplace/books')->as('marketplace.books.')->group(function () {

        Route::get('/', [BuyerMarketplaceBookController::class, 'index'])->name('index');
        Route::get('/load-more/{offset}', [BuyerMarketplaceBookController::class, 'loadMore'])->name('loadMore');
        Route::get('/filter', [BuyerMarketplaceBookController::class, 'applyFilter'])->name('applyFilter');

        Route::get('/{id}', [BuyerMarketplaceBookController::class, 'show'])->name('show');
    });



    Route::prefix('posts')->as('posts.')->group(function () {

        Route::get('/', [BuyePostController::class, 'index'])->name('index');
        Route::get('/load-more/{offset}', [BuyePostController::class, 'loadMore']);
        Route::post('/', [BuyePostController::class, 'storePost'])->name('store');
        Route::post('/{post}/like', [BuyePostController::class, 'toggleLike'])->name('likes');
        Route::post('/{post}/comment/create', [BuyePostController::class, 'addComment'])->name('comments');

    });



    Route::prefix('chat')->as('chat.')->group(function () {

        Route::get('/', [ChatController::class, 'index'])->name('index');
        Route::get('/{id}', [ChatController::class, 'getConversation'])->name('conversation');
        Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('message.send');
        Route::post('/mark-as-read', [ChatController::class, 'markAsRead'])->name('markAsRead');
    });


    // payment routes:
    Route::prefix('payment')->as('payment.')->group(function () {

        // stripe :
        Route::prefix('stripe')->as('stripe.')->group(function () {

            // Route::get('/', [StripeController::class, 'index'])->name('index');
            Route::post('/checkout/{id}', [StripeController::class, 'createSession'])->name('checkout');
            Route::get('/success/{id}', [StripeController::class, 'success'])->name('success');

        });


    });
});





