<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(auth()->guard('admin')->user()->type != 'super admin' && count(auth()->guard('admin')->user()->roles()->where('name', $role)->get()) == 0 ){
            return abort(401);
        }
        // return abort(401);
        return $next($request);
    }
}
