<?php

namespace App\Classes;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithValidation;

class CouponImport implements ToModel, WithValidation
{

    public function rules(): array
    {
        return [
            '*.0' => [
                'required',
                //Rule::unique('coupons', 'name')
            ],
        ];
    }

    public function model(array $row)
    {

        return Coupon::firstOrCreate(
            ['name' => trim($row[0])],
            [
                'discount' => trim($row[1]),
                'limit' => trim($row[2]),
                'description' => trim($row[3]),
                'available_until' => Carbon::now()->addMonth()->setTime(23, 59)->format('Y-m-d H:i'),
                'actived' => 1,
                'deleted' => 0
            ]
        );

           /*   return new Coupon([
                'name' => trim($row[0]),
                'discount' => trim($row[1]),
                'limit' => trim($row[2]),
                'description' => trim($row[3]),
                'available_until' => Carbon::now()->addMonth()->setTime(23, 59)->format('Y-m-d H:i'),
                'actived' => 1,
                'deleted' => 0
            ]); */

    } //model





} //class