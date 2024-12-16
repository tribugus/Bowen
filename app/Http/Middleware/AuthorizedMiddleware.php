<?php

namespace App\Http\Middleware;

//use App\Helpers\RoleHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Cookie;

class AuthorizedMiddleware
{
    /**
    * Handle an incoming request.
    *
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */

    public function handle(Request $request, Closure $next, $permiso = null): Response
    {
        $pos = strpos($permiso, HAR());
        if($pos === false) {
            abort(403, 'No autorizado.');
        } else {
            return $next($request);
        }
    }

}

