<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Session;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin_login=Session::get('admin_name');
//        $methos=$request->method();
        if (!$admin_login ){
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
