<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Auth\AuthenticationException;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //     return response()->json(['code' => 401, 'msg' => '未登录']);
    //     // if (! $request->expectsJson()) {
    //     //     return route('login');
    //     // }
    // }

    public function handle($request, \Closure $next, ...$guards)
    {
        if (auth('api')->check()) {
            $this->authenticate($request, $guards);

            return $next($request);
        }
        return response()->json(['code' => 401, 'msg' => 'token已过期，请重新登陆']);
    }
}
