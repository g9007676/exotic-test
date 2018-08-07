<?php

/**
 * Created by PhpStorm.
 * User: adbert
 * Date: 2018/8/7
 * Time: 下午2:25
 */
class BookFlightManager
{
    use ClientTrait;

    const URL = 'https://helloticket.com/book';

    protected $bookingSession;
    /**
     * OrderManager constructor.
     * @param BookingSession $bookingSession
     */
    public function __construct(BookingSession $bookingSession)
    {
        $this->bookingSession = $bookingSession;
    }

    public function store()
    {
        try {
            $this->request(
                'post',
                static::URL,
                ['id' => $this->bookingSession['bookingId']]
            );

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}