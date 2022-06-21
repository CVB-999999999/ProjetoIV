<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasPermissions
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */

    public function handle(Request $request, Closure $next, $role)
    {
        // No session
        if(Auth::user() == null) {
            return redirect('/login');
        }
        // Not enough permissions
        if ($request->user()->id_tipoUtilizador != $role) {
            return redirect('/');
        }
        // Normal
        return $next($request);
    }
}
