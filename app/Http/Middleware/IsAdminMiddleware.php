<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //dd(Auth::check());
        if (Auth::check()) {
            if(Auth::guard($guard)->user()->type != 'admin'){
                if ($request->ajax()) {
                    return response('Unauthorized.', 401);
                } else {
                    return redirect()->to('login');
                }
            }
            
        }else{
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->to('login');
            }
        }

        return $next($request);
    }
}
