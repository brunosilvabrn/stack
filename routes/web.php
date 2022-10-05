<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('user.login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('user.authenticate');
Route::get('/register', [RegisterController::class, 'index'])->name('user.register');
Route::post('/register/create', [RegisterController::class, 'create'])->name('user.create');
Route::get('/question/{slug}', [QuestionController::class, 'show'])->name('question.show');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::get('/ask', [QuestionController::class, 'index'])->name('ask');
    Route::post('/ask/create', [QuestionController::class, 'create'])->name('ask.create');
    Route::post('/ask/like', [AnswerController::class, 'like'])->name('ask.like');
    Route::post('answer/create/{id}', [AnswerController::class, 'create'])->name('answer.create');
    Route::delete('question/delete', [QuestionController::class, 'destroy'])->name('question.delete');

    Route::get('/logout', [LoginController::class, 'destroy'])->name('user.logout');
});
