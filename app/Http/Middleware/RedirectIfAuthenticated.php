<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class RedirectIfAuthenticated {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        if (Sentinel::check() && Sentinel::hasAnyAccess(['admin.*'])) {
            return redirect()->home();
        } else if (!Sentinel::check()) {
            return redirect()->route('login');
        }
        return $next($request);
    }

}
