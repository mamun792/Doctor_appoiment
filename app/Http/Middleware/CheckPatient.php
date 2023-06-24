<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPatient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */




public function handle($request, Closure $next, ...$roles)
{
    if (!$request->user()) {
        return redirect('/login');
    }

    foreach ($roles as $role) {
        if ($request->user()->role === $role) {
            return $next($request);
        }
    }

    abort(403, 'Unauthorized');
}
}
