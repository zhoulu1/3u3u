<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthVerify
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
        $openid = $request['openid'];
        if(empty($openid)){
            return response()->json(['code' => 401, 'msg' => '未登录']);
        }
        $check = User::where('openid', $openid)->first();
        if(!$check){
            return response()->json(['code' => 401, 'msg' => '未注册']);
        }
        return $next($request);
    }
}
