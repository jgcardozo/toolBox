<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;



class Webinar extends Model
{

    /*
    protected $casts = [
        'time' => 'datetime',
        'timeEnd' => 'datetime',
    ];
    */

    protected $fillable = [
        'show',
        'time',
        'timeEnd',
        'value',
        'smsListId',
        'smsText1',
        'smsText2',
        'calendarTitle',
        'calendarDescription'
    ];



} //class