<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User Route
Route::get('all-user', [UserController::class, 'index'])->name('all.user');
Route::post('register', [UserController::class, 'userAdd']);
Route::get('edit-user/{id}', [UserController::class, 'userEdit']);
Route::post('user-update', [UserController::class, 'userUpdate']);
Route::get('user-delete/{id}', [UserController::class, 'userDelete']);

// Book Route
Route::get('all-book', [BookController::class, 'index'])->name('all.book');
Route::post('add-book', [BookController::class, 'bookAdd']);
Route::get('edit-book/{id}', [BookController::class, 'bookEdit']);
Route::post('book-update', [BookController::class, 'bookUpdate']);
Route::get('book-delete/{id}', [BookController::class, 'bookDelete']);
