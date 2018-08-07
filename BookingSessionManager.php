<?php

/**
 * Created by PhpStorm.
 * User: adbert
 * Date: 2018/8/7
 * Time: 下午2:25
 */
class BookingSessionManager
{
    use ClientTrait;

    const CREATE_URL = 'https://helloticket.com/create';

    protected $bookingSessionRepository;

    /**
     * OrderManager constructor.
     * @param BookingSessionRepository $bookingSessionRepository
     */
    public function __construct(BookingSessionRepository $bookingSessionRepository)
    {
        $this->bookingSessionRepository = $bookingSessionRepository;
    }

    public function store()
    {
        $bookingSession = new BookingSession();
        try {
            $responseData = $this->request(
                'post',
                static::CREATE_URL,
                ['authKey' => '1234567890']
            );
            return $this->bookingSessionRepository->save($responseData, $bookingSession);
        } catch (\Exception $e) {
            return false;
        }
    }
}