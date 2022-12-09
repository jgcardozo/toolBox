<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); 
// ->middleware('can:dashboard')

Route::resource('users', UserController::class)->names('users');
Route::resource('roles', RoleController::class)->names('roles');

// falta rolesNpermissions and lang
Route::view('clients', 'livewire.clients.index')->name('clients');
Route::get('clients/{client}', [ClientController::class, 'formImage'])->name('clients.formImage');
Route::post('clients/storeImage', [ClientController::class, 'storeImage'])->name('clients.storeImage');
Route::get('clients/{id}/show', [ClientController::class, 'show'])->name('clients.show');

Route::view('products', 'livewire.products.index')->name('products');
Route::get('products/{product}', [ProductController::class, 'formImage'])->name('products.formImage');
Route::post('products/storeImage', [ProductController::class, 'storeImage'])->name('products.storeImage');
Route::get('products/{id}/show', [ProductController::class, 'show'])->name('products.show');


/*
Route::get('/articles', 'App\Http\Controllers\ArticlesController@index');
Route::post('/articles', 'App\Http\Controllers\ArticlesController@store');
Route::get('/articles/create', 'App\Http\Controllers\ArticlesController@create');
Route::get('/articles/{article}', 'App\Http\Controllers\ArticlesController@show');
Route::get('/articles/{article}/edit', 'App\Http\Controllers\ArticlesController@edit');
Route::put('/articles/{article}/edit', 'App\Http\Controllers\ArticlesController@update');
*/


