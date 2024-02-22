<?php

use App\Http\Controllers\Auth\GoogleSocialiteController;
use App\Http\Controllers\PostController;
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

    Route::get('/posts/list', [PostController::class, 'index'])->name('post.list');
    Route::get('/posts/allpost', [PostController::class, 'getAllPosts'])->name('post.getAll');

    
    Route::middleware('roles:SuperAdmin,Admin')->group(function(){
        Route::get('posts/create', [PostController::class, 'create'])->name('post.create');
        Route::post('posts/create', [PostController::class, 'store'])->name('post.store');
        Route::get('posts/list/edit/{id}',[PostController::class, 'getEditPostData'])->name('post.getEdit');
        Route::post('posts/list/edit',[PostController::class, 'edit'])->name('post.edit');

        Route::middleware('roles:SuperAdmin')->group(function(){
            Route::get('posts/list/delete/{id}',[PostController::class, 'delete'])->name('post.delete');
            
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    });
});

require __DIR__.'/auth.php';
