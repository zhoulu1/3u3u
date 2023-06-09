<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EasyWeChat\Pay\Application;

class UsersController extends Controller
{
    public function me(Request $request){
        return jsonData(200, 'success', $request->user());
    }
}
