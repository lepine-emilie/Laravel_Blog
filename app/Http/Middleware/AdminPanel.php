<?php

namespace App\Http\Middleware;

use Closure;

class AdminPanel
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
        $user = $request->user();
        if ($user && $user->hasRole('Admin')){
            return $next($request);
        }
        abort(404);
    }
}
