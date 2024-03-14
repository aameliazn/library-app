<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
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

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register/user', 'registerUser')->name('register.user');
    Route::post('register/admin', 'registerAdmin')->name('register.admin');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->name('logout');
});

Route::controller(BookController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
    Route::post('book/create', 'store')->name('book.create');

    Route::post('book/category/create', 'create')->name('book.category.create');
});

Route::controller(LoanController::class)->group(function () {
    Route::post('loan/create/{book}', 'store')->name('loan.create');
    Route::put('loan/delete/{loan}', 'update')->name('loan.delete');
});
