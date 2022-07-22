<?php

use App\Http\Controllers\PostController;
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

Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/create', [PostController::class, 'create'])->middleware(['auth'])->name('dashboard.create');
Route::post('/dashboard/store', [PostController::class, 'store'])->middleware(['auth'])->name('dashboard.store');
Route::get('/dashboard/{post}/edit', [PostController::class, 'edit'])->middleware(['auth'])->name('dashboard.edit');
Route::post('/dashboard/update/{post}', [PostController::class, 'update'])->middleware(['auth'])->name('dashboard.update');
Route::get('/dashboard/delete/{post}', [PostController::class, 'delete'])->middleware(['auth'])->name('dashboard.delete');

require __DIR__.'/auth.php';
