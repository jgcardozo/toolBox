<?php

namespace App\Models;

use App\Models\CouponDetail;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Accessors = get : como mostrar al user
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('Y-m-d H:i'); 
    }


    public function setAvailableUntilAttribute($value)
    {
        $this->attributes['available_until'] = Carbon::parse($value)->format('Y-m-d H:i');
        //return Carbon::parse($value)->format('Y-m-d H:i');
    }

    public function getAvailableUntilAttribute($value){
        return Carbon::parse($value)->format('Y-m-d H:i'); 
    }
    
    
    public function getDiscountAttribute($value){
        return number_format(str_replace(',', '', $value), 0); 
    } 

    
    public function getLimitAttribute($value){
        return number_format(str_replace(',','',$value),0); 
    } 

   


    //mutators = set : como guardar en la bd
    public function setNameAttribute($value){
        $this->attributes['name'] = strtoupper($value);
    }

    public function setDiscountAttribute($value){
        $this->attributes['discount'] = str_replace(',','',$value);
    }

    
    public function setLimitAttribute($value){
        $this->attributes['limit'] = str_replace(',','',$value);
    }


    public function getTimesUsedAttribute()
    {
        return CouponDetail::where('coupon', $this->name)->count();
    } 

    public function setTimesUsedAttribute($value)
    {
        $this->attributes['times_used'] = $value;
    }

 

    

}//class
