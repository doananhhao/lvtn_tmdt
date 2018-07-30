<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class m_admin
{
    /**
     * Handle an incoming request.
     * Quản trị viên (loại admin) luôn được phép login không xét TRANGTHAI
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //xét trạng thái MỌI TÀI KHOẢN
        // if (Auth::check())
        //     if(Auth::User()->trangthai == 0){
        //         $name = Auth::User()->name;
        //         Auth::logout();
        //         return redirect()->route('login')->with('inactive', 'Tài khoản '.$name.' đang bị khóa và không thể sử dụng được');
        //     }

        if (Auth::check())
            if (Auth::User()->hasRole('Người dùng') == null)
                if (Auth::User()->trangthai == 1 || Auth::User()->hasRole('Quản trị viên') != null)
                    return $next($request);
                else{
                    $name = Auth::User()->name;
                    Auth::logout();
                    return redirect()->route('login')->with('inactive', 'Tài khoản '.$name.' đang bị khóa nên không thể sử dụng chức năng của quản lý website');
                }
        
        return redirect('/home');
    }
}
