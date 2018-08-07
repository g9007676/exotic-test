<?php

/**
 * Created by PhpStorm.
 * User: adbert
 * Date: 2018/8/7
 * Time: 下午2:26
 */
class OrderRepository
{
    const PAID_STATUS = 'paid';
    const PAY_FAILED_STATUS = 'payFailed';
    const PAYING_FAILED_STATUS = 'paying';

    public function save($args, $order)
    {
        $order->origin = $args['origin'];
        $order->destination = $args['destination'];
        $order->date = $args['date'];
        $order->currency = 'TWD';
        $order->price = $args['price'];
        $order->status = static::PAYING_FAILED_STATUS;
        $order->save();

        return $order;
    }

    public function updateStatus($order, $status)
    {
        $order->status = $status;
        $order->save();

        return $order;
    }
}