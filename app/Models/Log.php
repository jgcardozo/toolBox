<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
    use HasFactory;


    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i');
    }







    public function getUserNameAttribute()
    {
        return User::where('id', $this->user_id)->first()->name;
    }

    public function setUserNameAttribute($value)
    {
        $this->attributes['user_name'] = $this->user_name;
    }


    //relations

    public function logable(){
        return $this->morphTo();
    }


}//class
