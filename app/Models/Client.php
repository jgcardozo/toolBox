<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'clients';

    protected $fillable = ['id_nro', 'id_type', 'client_type', 'name', 'email', 'phone', 'address', 'city_id'];

    public function city(){
        return $this->belongsTo('App\Models\City');
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

}//class
