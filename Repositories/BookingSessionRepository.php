<?php

/**
 * Created by PhpStorm.
 * User: adbert
 * Date: 2018/8/7
 * Time: 下午2:27
 */
class BookingSessionRepository
{
    public function save($args, $bookingSession)
    {
        $bookingSession->id = $args['bookingId'];
        $bookingSession->expire = $args['expireTime'];
        $bookingSession->save();

        return $bookingSession;
    }

}