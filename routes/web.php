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
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::resource('recipe', RecipeController::class);
    Route::put('recipe/{recipe}/like', [RecipeController::class, 'like'])->name('recipe.like');

    Route::prefix('/comment')->group(function () {
        Route::get('/edit/{comment_id}', [CommentController::class, 'edit'])->name('comment.edit');
        Route::put('/update', [CommentController::class, 'update'])->name('comment.update');
        Route::post('/store', [CommentController::class, 'store'])->name('comment.store');
    });

    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('/changeUsername', [UserController::class, 'changeUsernameShow'])->name('user.changeUsername');
        Route::put('/changeUsername', [UserController::class, 'changeUsername'])->name('user.changeUsername');
    });
});
Route::get('/search', [RecipeController::class, 'fetchByName'])->name('search');
Route::get('/{category}', [HomeController::class, 'filter'])->name('filter');


Route::fallback(function () {
    return redirect()->route('home');
});
