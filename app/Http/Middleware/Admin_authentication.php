<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class Admin_authentication
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

        if(!Auth::guard('admin')->check()) {            
            Toastr::error('Please Login to continue','',["timeOut" => 10000]);
            return redirect('admin/login');
        } 
        return $next($request);
    }
}
