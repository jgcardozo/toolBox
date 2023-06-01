<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $domains = Domain::select('domains.id', 'domains.name', 'domains.type', DB::raw('COALESCE(COUNT(links.id), 0) as cant'))
            ->leftJoin('links', 'domains.id', '=', 'links.domain_id')
            ->groupBy('domains.name', 'domains.type', 'domains.id')
            ->orderBy('domains.name', 'asc')
            ->get();
        //debug($domains);
        return view('dashboard', compact('domains'));
        
    }





} //class
