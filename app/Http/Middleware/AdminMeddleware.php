<?php

namespace App\Http\Middleware;

use Closure;

use Sentinel;
class AdminMeddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Sentinel::check() && Sentinel::getUser()->hasAnyAccess(['admin.*', 'moderator.*'])) {
            return $next($request);
        } else {
            return redirect()->back()->with('error', 'you do not have permissions to come here');
        }
    }

}
