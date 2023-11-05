<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        if(!Auth::check()){
            return redirect()->route('login');
        }
        if(Auth::user()->is_admin ==1 && Auth::check()){
            return $next($request);
        }
        elseif(!Auth::check()){
            return redirect()->back();
        }
        return redirect()->back()->with('unauthorised', 'You are
        unauthorised to access this page');}
    }
