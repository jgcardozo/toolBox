<?php
//use App\Http\Livewire\PageClose;
//use App\Http\Controllers\PageCloseController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\CouponController;
use App\Http\Livewire\Coupons;



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

Route::get('logtype/{model}', [LogController::class, 'logtype'])->name('log.type');


Route::view('coupons', 'livewire.coupons.index')->name('coupons.index');
Route::get('coupons/{coupon}', [CouponController::class, 'couponExists'])->name('coupons.exists');
//Route::resource('coupons', CouponController::class)->names('coupons');

Route::get('htproceso/{domain}', [LinkController::class, 'htproceso'])->name('links.htproceso');

//Route::resource('closepages', PageCloseController::class)->names('closepages');
//Route::get('/closepages', PageClose::class)->name('closepages');

