<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
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
        $user = Auth::user();

        if($user){
            if ($user->can('all-pages')) {
                return $next($request);
            } elseif ($user->can('except-users')) {
                if ($request->is('products*')) {
                    return $next($request);
                } else {
                    echo "HERE";
                    return redirect()->back();
                }
            } elseif ($user->can('user')){
                if($request->is('products')){
                    return $next($request);
                } else {
                    return redirect('/');
                }
            }
        }
        return redirect('/');
    }
}
