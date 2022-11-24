<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); 
// ->middleware('can:dashboard')

Route::resource('users', UserController::class)->names('users');
Route::resource('roles', RoleController::class)->names('roles');



Route::view('clients', 'livewire.clients.index')->name('clients'); //->middleware('auth');

/*
Route::get('/articles', 'App\Http\Controllers\ArticlesController@index');
Route::post('/articles', 'App\Http\Controllers\ArticlesController@store');
Route::get('/articles/create', 'App\Http\Controllers\ArticlesController@create');
Route::get('/articles/{article}', 'App\Http\Controllers\ArticlesController@show');
Route::get('/articles/{article}/edit', 'App\Http\Controllers\ArticlesController@edit');
Route::put('/articles/{article}/edit', 'App\Http\Controllers\ArticlesController@update');*/

//Route::get('/products', [ProductController::class, 'index'])->name('product.index');

