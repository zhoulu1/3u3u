<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\WeappAuthorizationRequest;
use App\Models\User;
use EasyWeChat\MiniApp\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizationsController extends Controller
{
    public function weappStore(WeappAuthorizationRequest $request)
    {
        $code = $request->code;
        // 根据 code 获取微信 openid 和 session_key
        $config = config('easywechat.mini.default');
        $app = new Application($config);
        $response = $app->getClient()->get('/sns/jscode2session', [
            'js_code' => $code,
            'appid'  => $config['app_id'],
            'secret' => $config['secret'],
            'grant_type' => 'authorization_code'
        ]);
        if ($response->isFailed()) {
           return jsonData($response['errcode'], $response['errmsg']);
        }
        // // 找到 openid 对应的用户
        $user = User::where('openid', $response['openid'])->first();

        // 未找到对应用户则需要提交用户名密码进行用户绑定
        if (!$user) {
            $user = User::create([
                'openid' => $response['openid'],
            ]);
        }
        $token = Auth::guard('api')->login($user);
        return jsonData(200, '', ['token' => $token]);
    }
}
