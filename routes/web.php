<?php

use App\Http\Livewire\Coupons;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;



Route::get('/', function () {
    return view('auth/login');
   //return view('welcome');
});


Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard'); 


Route::resource('users', UserController::class)->names('users');
Route::resource('roles', RoleController::class)->names('roles');
Route::resource('permissions', PermissionController::class)->names('permissions');
Route::resource('domains', DomainController::class)->names('domains');

Route::resource('links', LinkController::class)->names('links');
Route::get('htproceso/{domain}', [LinkController::class, 'htproceso'])->name('links.htproceso');

Route::get('logtype/{model}', [LogController::class, 'logtype'])->name('log.type');


//livewire mount -> middleware auth

Route::view('coupons', 'livewire.coupons.index')->name('coupons.index');

Route::view('closepages', 'livewire.closepages.index')->name('closepages.index');



