<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('admin/users', [AdminController::class, 'usersList'])->name('admin.users.list');
Route::get('admin/products', [AdminController::class, 'productsList'])->name('admin.products.list');

/*
Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('admin/template', [AdminController::class, 'template'])->name('admin.template');
 * */

Route::apiResource('/users',UserController::class);
Route::get('/users/change_state/{id}', [UserController::class, 'changeState'])->name('user.changeState');
