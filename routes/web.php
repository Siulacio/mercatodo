<?php

use App\Http\Controllers\ProductController;
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

//admin routes
Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('admin/users', [AdminController::class, 'usersList'])->name('admin.users.list');
Route::get('admin/products', [AdminController::class, 'productsList'])->name('admin.products.list');

//users routes
Route::apiResource('/users',UserController::class);
Route::get('/users/change_state/{id}', [UserController::class, 'changeState'])->name('user.changeState');

//products routes
Route::apiResource('/products', ProductController::class);
Route::get('/products/images/{product}',[ProductController::class,'showProductImages'])->name('product.images');
Route::get('/products/images/delete/{image}',[ProductController::class,'destroyImage'])->name('product.image.destroy');
Route::post('/products/update/{product}',[ProductController::class, 'update'])->name('product.update');
Route::get('/products/change_state/{id}',[ProductController::class, 'changeState'])->name('product.changeState');
Route::get('/products/export/excel',[ProductController::class, 'exportExcel'])->name('product.export.excel');
Route::post('/products/import/excel',[ProductController::class, 'importExcel'])->name('product.import.excel');
Route::get('/showcase',[ProductController::class, 'showcase'])->name('showcase');
