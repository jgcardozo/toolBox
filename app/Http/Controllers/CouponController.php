<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
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



    public function couponExists($coupon){
        $exists = Coupon::select('name', 'discount', 'limit', 'available_until', 'type')->where('name', strtoupper($coupon) )->get();

        if (count($exists->toArray()) < 1) {
            abort(401);  
            $exists["available_until"] = 0;      
        }
        echo $exists->toJson(); 
    } // couponExists


}//class
