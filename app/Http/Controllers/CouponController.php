<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {/*
        $this->middleware('can:coupons.index')->only('index');
        $this->middleware('can:coupons.create')->only('create', 'store');
        $this->middleware('can:coupons.edit')->only('edit', 'update');
        $this->middleware('can:coupons.destroy')->only('destroy'); 
        */
    } //construct


    public function index()
    {
        return view('livewire.coupons.index');
    } //index

}//class
