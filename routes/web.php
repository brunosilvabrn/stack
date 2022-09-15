<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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
    return view('home');
});

Route::get('/login', [LoginController::class, 'index'])->name('user.login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('user.authenticate');
Route::get('/register', [RegisterController::class, 'index'])->name('user.register');
Route::post('/register/create', [RegisterController::class, 'create'])->name('user.create');


Route::middleware('auth')->group(function () {
    Route::get('/teste', function () {
        return 'tew';
    });

    Route::get('/logout', [LoginController::class, 'destroy'])->name('user.logout');
});
