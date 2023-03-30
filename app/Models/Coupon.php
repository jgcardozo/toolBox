<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Accessors = get : como mostrar al user
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('Y-m-d H:i'); 
    }

    public function getAvailableUntilAttribute($value){
        return Carbon::parse($value)->format('Y-m-d H:i'); 
    }
    
    
    public function getDiscountAttribute($value){
        //return number_format($value,0);
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

    

}//class
