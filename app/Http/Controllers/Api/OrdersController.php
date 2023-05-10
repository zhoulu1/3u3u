<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrdersRequest;
use App\Models\Orders;
use App\Models\ReceiveLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function store(OrdersRequest $request){
       
        DB::transaction(function () use ($request) {
            $user = $request->user();
            $param = $request->only(['category_id', 'weight_desc', 'appointment_time', 'remark', 'address']);
            $order = new Orders($param);
            // 订单关联到用户
            $order->user()->associate($user);
            $order->save();
        });
        return jsonData(200, 'success!');
    }

    public function index(Request $request){
        $page_size = $request->page_size ?: 15;
        $builder = Orders::query()->where('user_id', $request->user()->id);
        if($request->status) $builder->where('status', $request->status);
        $list = $builder->with(['category','recycler'])->orderBy('created_at', 'desc')->paginate($page_size);
        return response()->json(['code' => 200,'msg' => 'success','data' => $list]);
    }

    public function receive(Request $request){
        if(empty($request['order_id'])){
            return jsonData(400, '参数错误！');
        }
        DB::transaction(function () use ($request) {
            $receiveLog = new ReceiveLog([ 'order_id' => $request['order_id'] ]);
            $receiveLog->user()->associate($request->user());
            $receiveLog->save();
            Orders::where('id', $request['order_id'])->update(['recycler_id' => $request->user()->id, 'status' => Orders::STATUS_DELIVERING]);
        });
        return jsonData(200, 'success!');
    }
}
