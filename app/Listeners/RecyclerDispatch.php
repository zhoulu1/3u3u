<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Orders;
use App\Models\Recycler;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RecyclerDispatch
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
     * @param  \App\Events\OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        // 给回收员分配订单
        $order = $event->getOrder();
        $address = $order['address'];
        $recycler = Recycler::where('status', 'passed')->where('province', $address['province'])->where('city', $address['city'])->where('county', $address['county'])->first();
        $order->recycler_id = $recycler['id'];
        $order->save();
    }
}
