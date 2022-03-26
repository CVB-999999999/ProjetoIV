<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class sessionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $teste = Session::get('tipo');
        View::share('user', false);
        $nome = Session::get('name');
        View::share('nome', $nome);
    
        if($teste == 2){
            View::share('aluno', true);
            View::share('prof', false);
            View::share('user', true);
        }elseif($teste == 1){
            View::share('aluno', false);
            View::share('prof', true);
            View::share('user', true);
        }
        return $next($request);
    }
}
