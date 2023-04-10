<?php

namespace App\Http\Livewire;

use App\Models\Log;
use Livewire\Component;

class Logs extends Component
{
    public function render()
    {
        $logs = Log::where('logable_type','App\Models\Link')->orderBy('created_at','desc')->get();
        return view('livewire.logs.links', compact('logs'));
    }//render


    



}//class
