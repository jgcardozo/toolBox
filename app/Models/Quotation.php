<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'products';

    protected $guarded = [];



    
}//class
