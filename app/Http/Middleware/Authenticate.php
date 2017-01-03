<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (Auth::guard()->guest()) {
        if ($request->ajax() || $request->wantsJson()) {
           return response('Unauthorized.', 401);
        } else {
          if(!in_array(Route::currentRouteName(), ['login', 'logout'])) {
            return redirect()->guest(route('login'));
          }
        }
      }

      return $next($request);
    }
}
