<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
 
    public function couponExists($coupon){
        $exists = Coupon::select('name', 'discount', 'limit', 'available_until', 'type')->where('name', strtoupper($coupon) )->get();

        if (count($exists->toArray()) < 1) {
            abort(401);  
            $exists["available_until"] = 0;      
        }
        echo $exists->toJson(); 
    } // couponExists


    public function couponCount($coupon, $url){
        //contar un uso del coupon en CouponDetail::
    }//couponCount


}//class
