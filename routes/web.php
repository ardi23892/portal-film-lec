<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;

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

//Route::get('/', function () {
//    return view('home');
//});

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/details/{id}', [PageController::class, 'details'])->name('detail');
Route::get('/type/{id}', [PageController::class, 'types'])->name('types');
Route::get('/category/{id}', [PageController::class, 'categories']);
Route::post('/search', [PageController::class, 'search'])->name('search');
Route::get('/watch/{id}',[PageController::class, 'watch']);

Route::get('/admin', [PageController::class, 'admin'])->name('admin.home');

Route::get('/admin/category/{id}', [AdminController::class, 'category']);
Route::get('/admin/type/{id}', [AdminController::class, 'type']);
Route::get('/admin/create', [AdminController::class, 'create'])->name('create');
Route::get('admin/edit/{id}', [AdminController::class, 'show']);
Route::post('/admin/search', [PageController::class, 'admin_search'])->name('admin.search');

Route::post('/admin/create', [AdminController::class, 'store'])->name('create_new_content');
Route::post('/admin/edit/{id}', [AdminController::class, 'edit']);
Route::get('/admin/delete/{id}', [AdminController::class, 'delete']);

Route::get('/login', [PageController::class, 'index_login'])->name('index_login');
Route::post('/auth/login', [AdminController::class, 'login'])->name('login');

Route::get('/register', [PageController::class, 'index_register'])->name('index_register');
Route::post('/auth/register', [AdminController::class, 'register'])->name('register');

Route::get('/password/edit', [PageController::class, 'index_edit_password'])->name('index_edit_password');
Route::post('/auth/password/edit', [AdminController::class, 'edit_password'])->name('edit_password');

Route::post('/auth/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/profile', [PageController::class, 'profile'])->name('profile');

Route::post('/watchlist/add/{id}', [UserController::class, 'addToWatchList']);
Route::post('/rent/add/{id}', [UserController::class, 'rentMovie']);
