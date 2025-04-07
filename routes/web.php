<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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
//     return view('welcome');
// });
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/approve-user/{userId}', [AdminController::class, 'approveUser'])->name('admin.approveUser');
    Route::get('/admin/posts', [AdminController::class, 'viewAllPosts'])->name('admin.posts');
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/admin/posts/{post}', [AdminController::class, 'showPost'])->name('posts.show');
    Route::get('/admin/posts/{post}', [AdminController::class, 'showPost'])->name('posts.show');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    // Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

});
// Route::middleware(['auth'])->get('/tenant/dashboard', [AdminController::class, 'index'])->name('tenant.dashboard');