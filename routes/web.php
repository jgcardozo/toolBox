<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\LinkController;


Route::get('/', function () {
    return view('auth/login');
   // return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); 
// ->middleware('can:dashboard')

Route::resource('users', UserController::class)->names('users');
Route::resource('roles', RoleController::class)->names('roles');

Route::resource('domains', DomainController::class)->names('domains');
Route::resource('links', LinkController::class)->names('links');

// falta rolesNpermissions and lang



