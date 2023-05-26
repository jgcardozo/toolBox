<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosePage extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function getDomainNameAttribute()
    {
        return Domain::where('id', $this->domain_id)->first()->name;
    }
    public function setDomainNameAttribute($value)
    {
        $this->attributes['domain_name'] = $this->domain_name;
    }

    public function getUserNameAttribute()
    {
        return User::where('id', $this->user_id)->first()->name;
    }

    public function setUserNameAttribute($value)
    {
        $this->attributes['user_name'] = $this->user_name;
    }

    public function getCloseAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i');
    }



    public function getCloseAtStrAttribute()
    {
        return strtotime($this->created_at);
    }
    public function setCloseAtStrAttribute($value)
    {
        $this->attributes['close_at_str'] = $this->close_at_str;
    }







}//class
