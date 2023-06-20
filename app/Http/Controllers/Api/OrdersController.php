<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderCreated;
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
            event(new OrderCreated($order));
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

    public function finish(Request $request){
        if(empty($request['order_id'])){
            return jsonData(400, '参数错误！');
        }
        DB::transaction(function () use ($request) {
            Orders::where('id', $request['order_id'])->update([
                'status' => Orders::STATUS_FINISHED, 
                'weight' => $request['weight'],
                'total_amount' => $request['total_amount'],
                'remark' => $request['remark']
            ]);
        });
        return jsonData(200, 'success!');
    }

    public function receiveList(Request $request){
        $page_size = $request->page_size ?: 15;
        if($request->order == 'time'){
            $item = 'appointment_time';
            $order = 'asc';
        }else{
            $item = 'created_at';
            $order = 'asc';
        }
        
        $builder = Orders::query();
        if($request->status) $builder->where('status', $request->status);
        if($request->recycler_id) $builder->where('recycler_id', $request->user()->id);
        if($request->order == 'delivering'){
            $builder->where('recycler_id', $request->user()->id); 
            $builder->where('status', Orders::STATUS_DELIVERING); 
        }else if($request->order){
            $builder->where('status', Orders::STATUS_PENDING);
        }
        $list = $builder->with(['category','user'])->orderBy($item, $order)->paginate($page_size);
        return response()->json(['code' => 200,'msg' => 'success','data' => $list]);
    }
}
