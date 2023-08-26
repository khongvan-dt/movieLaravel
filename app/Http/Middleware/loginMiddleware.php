<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next, $role)
    {
        // dd($role);
        if ($role === ':customer' || $role === ':admin') {
            if (Auth::check()) {
                return $next($request);
            } else {
                return redirect()->route('login');
            }
        }
        return response("Unauthorized", 401); 
        // abort(403, 'Unauthorized');
    }
}
