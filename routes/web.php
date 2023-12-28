<?php

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

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::resource('recipe', RecipeController::class);
    Route::get('/user', [HomeController::class, 'user'])->name('user');
});
Route::get('/{category}', [HomeController::class, 'filter'])->name('filter');

Route::fallback(function () {
    return redirect()->route('home');
});
