<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrdersRequest;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function store(OrdersRequest $request){
        $user = $request->user();
        dump($request);die;
        $result = Orders::create($request);
    }
}
