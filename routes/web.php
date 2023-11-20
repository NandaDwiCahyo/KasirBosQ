<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->middleware('guest');
Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name("login");
Route::post('/login', [AuthController::class, 'loginPost']);
Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/register', [AuthController::class, 'registerPost']);
Route::get('/logout', [AuthController::class, 'logoutPost'])->middleware('auth');
Route::post('/logout', [AuthController::class, 'logoutPost']);

Route::get('/home', [HomeController::class, 'home'])->middleware('auth')->name("home");
Route::get('/home/search', [HomeController::class, 'search'])->middleware('auth');
Route::post('/home/search', [HomeController::class, 'search'])->middleware('auth');

Route::post('/home', [TransactionController::class, 'cart'])->middleware('auth');
Route::get('/home/clearcart', [TransactionController::class, 'clearCart'])->middleware('auth');
Route::post('/home/transaction', [TransactionController::class, 'transaction'])->middleware('auth');

Route::get('/product/history', [ProductController::class, 'history'])->middleware('auth');

Route::get('/product', [ProductController::class, 'index'])->middleware('auth');
Route::get('/product/create', [ProductController::class, 'create'])->middleware('auth');
Route::post('/product/create', [ProductController::class, 'store'])->middleware('auth');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->middleware('auth');
Route::post('/product/edit/{id}', [ProductController::class, 'update'])->middleware('auth');
Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->middleware('auth');

Route::get('/product/search/', [ProductController::class, 'search'])->middleware('auth');
Route::post('/product/search/', [ProductController::class, 'search'])->middleware('auth');

Route::get('/invoice/{checkout_code}', [ProductController::class, 'invoice'])->middleware('auth');
// Route::get('/invoice/{checkout_code}', [InvoiceController::class, 'invoice'])->middleware('auth');

Route::get('/user', [UserController::class, 'index'])->middleware('auth');
Route::get('/user/{id}', function () {
    return redirect('/user');
})->middleware('auth');
Route::post('/user/{id}', [UserController::class, 'destroy'])->middleware('auth');
