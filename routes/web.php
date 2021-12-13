<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('admin', '\App\Http\Controllers\AdminController@index')->name('admin.index');
Route::get('users/edit/{id}', '\App\Http\Controllers\UserController@edit')->name('user.edit');
Route::post('users/update', '\App\Http\Controllers\UserController@update')->name('user.update');
