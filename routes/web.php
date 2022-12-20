<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
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
Route::get('/details/{id}', [PageController::class, 'details']);
Route::get('/types', [PageController::class, 'types'])->name('types');
Route::get('/admin', [PageController::class, 'admin'])->name('admin.home');

Route::get('/admin/category/{id}', [AdminController::class, 'category']);
Route::get('/admin/type/{id}', [AdminController::class, 'type']);
Route::get('/admin/create', [AdminController::class, 'create'])->name('create');
Route::get('admin/edit/{id}', [AdminController::class, 'show']);

Route::post('/admin/create', [AdminController::class, 'store'])->name('create_new_content');
Route::post('/admin/edit/{id}', [AdminController::class, 'edit']);
