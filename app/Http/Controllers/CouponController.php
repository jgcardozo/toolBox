<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\Coupon;
use App\Models\CouponDetail;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{

    public function couponExists($coupon)
    {
        //juan aca voy , validar si esta habilitado , activo y demas    , hacer un job para que por fecha desabilite cupones
        $coupons = Coupon::select('name', 'discount', 'limit', 'available_until', 'type')
            ->where('name', strtoupper($coupon))
            ->where('deleted', 0)
            ->where('actived', 1)
            ->where('available_until', '>=', Carbon::now()->format('Y-m-d H:i'))
            ->first();

        if (is_null($coupons)) {
            return response()->json(["status" => 401, "statusText" => "Unauthorized"], 401);
        }
        $coupons['status'] = 200;
        $coupons['statusText'] = "Found";
        return response()->json($coupons, 200);
    } // couponExists


    public function couponCount(Request $request)
    {
        $data = $request->json()->all();
        try {
            CouponDetail::create([
                'coupon' => $data['coupon'],
                'url' => $data['url'],
                'affiliate_id' => $data['affiliate_id']
            ]);
            $response = ["status" => 200, "statusText" => "Coupon Successfully Counted."];
        } catch (QueryException $e) {
            $response = ["status" => 500, "statusText" => $e->getMessage()];
        }
        return response()->json($response, 200);

    } //couponCount



} //class
