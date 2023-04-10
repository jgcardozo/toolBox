<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
  public function logtype($model){
    //dd($model);
    return view('livewire.logs.index');
  }   
}//class
