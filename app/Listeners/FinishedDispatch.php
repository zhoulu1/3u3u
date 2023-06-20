<?php

namespace App\Listeners;

use App\Events\OrderFinished;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FinishedDispatch
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderFinished  $event
     * @return void
     */
    public function handle(OrderFinished $event)
    {
        // 订单结束后需要做的事
        // 1、把金额打到下单用户账户，并扣除回收员该比订单支付的金额
        // 2、回收员获得提成
        // 3、用户获得积分
        $order = $event->getOrder();
        // todo1
        // 下单用户的总收益和余额、积分
        User::where('id', $order->user_id)->increment('total', $order['total_amount']);
        User::where('id', $order->user_id)->increment('balance', $order['total_amount']);
        User::where('id', $order->user_id)->increment('integral', $order['total_amount']);
        // 回收员的
        User::where('id', $order->recycler_id)->decrement('total', $order['total_amount']);
        
    }
}
