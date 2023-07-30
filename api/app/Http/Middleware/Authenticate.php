<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // 認証されていないときに403エラーを起こす
        if ($request->is('api/*')) {
            return response()->error(Response::HTTP_OK, '許可されていません。一度ログアウトしてから再度お試しください。');
        }

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
