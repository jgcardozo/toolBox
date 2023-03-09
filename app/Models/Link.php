<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Link extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'links';

    protected $guarded = [];


    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i - e');
    }

    public function getDomainNameAttribute()
    {
        return Domain::where('id', $this->domain_id)->first()->name;
    }

    public function setShortUrlAttribute($value)
    {
        $this->attributes['short_url'] = "http://" . $this->domain_name . '/' . $this->alias;
    }


    
    public function getUserNameAttribute()
    {
        return User::where('id', $this->user_id)->first()->name;
    }

    
    public function setUserNameAttribute($value)
    {
        $this->attributes['user_name'] = $this->user_name;
    } 

}//class
