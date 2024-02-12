<?php

use App\Http\Controllers\Auth\GoogleSocialiteController;
use App\Http\Controllers\ProfileController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/dashboard', function () {
    return view('pages.dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/team', function () {
    return view('pages.team.team');
})->middleware(['auth', 'verified'])->name('team');

Route::get('/login/{social}', [GoogleSocialiteController::class, 'redirectToGoogle'])->where('social','twitter|facebook|linkedin|google|github|bitbucket');  // redirect to google login
Route::get('/login/{social}/callback', [GoogleSocialiteController::class, 'handleCallback']);    // callback route after google account chosen

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts/list', function(){
        return view('pages.posts.post_list');
    })->name('post.list');

    Route::get('posts/create', function(){
        return view('pages.posts.post_create');
    })->name('post.create');

    Route::get('posts/list/{id?}', function(){
        return view('pages.posts.post_edit');
    })->name('post.edit');
});

require __DIR__.'/auth.php';
