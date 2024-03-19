<?php

namespace App\Classes;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CouponDetailExport implements FromCollection, WithHeadings
{
    protected $couponDetail;

    public function __construct($couponDetail)
    {
        $this->couponDetail = $couponDetail;
    }

    public function collection()
    {
        return $this->couponDetail;
    }



    public function headings(): array
    {
        return [
            'Id',
            'Coupon',
            'AffiliateID',
            'Email',
            'Url',
            'Created_At',
            'Updated_At'
        ];
    }


}// class