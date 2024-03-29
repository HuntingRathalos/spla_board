<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Response;
use Illuminate\Http\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // return response()->error(Response::HTTP_FORBIDDEN, '一度ログアウトしてから再度お試しください。');
            if (Auth::guard($guard)->check()) {
                return response()->error(Response::HTTP_FORBIDDEN, '一度ログアウトしてから再度お試しください。');
                // return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
