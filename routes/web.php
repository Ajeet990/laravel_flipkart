<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('inc/welcome');
// });
// Route::get('/login', function() {
//     return view('inc/login');
// });

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/flipkartHome', [HomeController::class, 'flipkartHome'])->name('flipkart.Home');


Route::middleware('auth')->group(function() {
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    Route::get('/register', [AuthController::class, 'show_register'])->name('show_register');
    Route::get('/login', [AuthController::class, 'show_login'])->name('show_login');
    Route::get('/enter_otp', [AuthController::class, 'show_enter_otp'])->name('show_enter_otp');
    Route::post('/login', [AuthController::class, 'login'])->name('form.login');
    // Route::post('/submit_otp', [AuthController::class, 'submit_otp'])->name('submit.otp');
    Route::post('/submit_otp', [AuthController::class, 'submit_otp'])->name('submit.otp');
});

Route::middleware('checkLoggedInUser')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/my_cart', [UserController::class, 'myCart'])->name('my.cart');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('new_product', [UserController::class, 'newProduct'])->name('new_product');
    Route::post('add_new_product', [UserController::class, 'addNewProduct'])->name('add_new_product');
    Route::post('/add_to_cart', [HomeController::class, 'addToCart'])->name('add-to-cart');
    Route::post('/remove_from_cart', [HomeController::class, 'remove_from_cart'])->name('remove_from_cart');
});


Route::get('/productDetail/{id}', [HomeController::class, 'showProductFullDetail'])->name('product.show');
Route::post('/be_a_seller', [UserController::class, 'becomeASeller'])->name('become.a.seller');

// Admin related routes

Route::get('/adminLogin', [AdminController::class, 'show_login'])->name('form.showAdminLogin');
Route::post('/adminLogin', [AdminController::class, 'login'])->name('form.adminLogin');
Route::get('/logoutAdmin', [AdminController::class, 'logout'])->name('logoutAdmin');