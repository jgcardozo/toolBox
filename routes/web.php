<?php

//use App\Http\Livewire\PageClose;
//use App\Http\Livewire\ShowCoupons;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\PermissionController;
//use App\Http\Controllers\PageCloseController;


Route::get('/', function () {
    return view('auth/login');
   //return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); 
// ->middleware('can:dashboard')


Route::resource('roles', RoleController::class)->names('roles');
Route::resource('domains', DomainController::class)->names('domains');
Route::resource('permissions', PermissionController::class)->names('permissions');

Route::resource('users', UserController::class)->names('users');
Route::resource('links', LinkController::class)->names('links');

// falta rolesNpermissions and lang

//Route::resource('closepages', PageCloseController::class)->names('closepages');
//Route::get('/closepages', PageClose::class)->name('closepages');

//Route::get('/coupons', ShowCoupons::class)->name('coupons');
Route::resource('coupons', CouponController::class)->names('coupons');





