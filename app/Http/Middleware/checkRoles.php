<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class checkRoles
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
        if (Auth::user()->isAdmin()=='admin'){
            return $next($request);
        }
        return redirect('home');
    }
}
