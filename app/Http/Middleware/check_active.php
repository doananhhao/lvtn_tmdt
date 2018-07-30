<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class check_active
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check())
            if (Auth::User()->trangthai == 1 || Auth::User()->hasRole('Quản trị viên') != null)
                return $next($request);
            else{
                $name = Auth::User()->name;
                Auth::logout();
                return redirect()->route('login')->with('inactive', 'Tài khoản '.$name.' đang bị khóa nên không thể sử dụng chức năng của website');
            }
        
        return $next($request);
    }
}
