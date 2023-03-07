<?php

namespace App\Models;

use App\Classes\Eds;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Domain extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'domains';

    protected $guarded = [];


    public function setFtpUrlAttribute($value)
    {
        $replacements = ["/site/wwwroot", "ftp://", "ftps://"];
        $this->attributes['ftp_url'] = str_replace($replacements, '', $value);
    }

    public function setFtpPasswordAttribute($value)
    {
        $this->attributes['ftp_password'] = Eds::encryption($value);
    }

  /*   public function getFtpPasswordAttribute()
    {
        return Eds::decryption($this->ftp_password);
    }
 */



} //class
