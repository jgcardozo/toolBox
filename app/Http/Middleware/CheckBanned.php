<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && (auth()->user()->status == 0)){
            $user = auth()->user()->email;
            Auth::logout();
            $request->session()->regenerate();
            $request->session()->invalidate();
            return redirect()->route('login')->with('error-login', $user.' '.__('login_suspended'));       
        }
        return $next($request);
    }//handle



}//class
