<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
  public function logtype($model)
  {
   
    $logs = [];
    switch ($model) {
      case 'Link':
        $logs = Log::where('logable_type', 'App\Models\Link')->orderBy('created_at', 'desc')->get();
        $view = 'livewire.logs.links';
        $logTitle = 'Log: Links';
        break;

      case 'Coupon':
        $logs = Log::where('logable_type', 'App\Models\Coupon')->orderBy('created_at', 'desc')->get();
        $view = 'livewire.logs.coupons';
        $logTitle = 'Log: Coupons';
        break;
    } //sw

    return view($view, compact('logs', 'logTitle'));


  }
} //class
