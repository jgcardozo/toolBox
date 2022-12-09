<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'products';

    protected $guarded = [];


    //accesor => get es para mostrar data personalizada
    public function getPriceAttribute($value)
    {
        return '$ '.number_format($value,0,',','.');
    }

    public function getProducttypeNameAttribute()
    {
        return ProductType::where('id', $this->producttype_id)->first()->description;
    }

    public function getBrandNameAttribute()
    {
        return Brand::where('id', $this->brand_id)->first()->description;  
    }

    public function getDescriptionAttribute($value)
    {
        return $this->brand_name.' - '.$value;
    } 


    //mutators => set es para formatear data antes de guardar en la db
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = strtoupper($value);
    }



    //relations
    public function producttype(){
        return $this->belongsTo('App\Models\ProductType');
    }

    //relationships
    public function images(){
        return $this->morphMany('App\Models\Image', 'imageable');
    }


}//class
