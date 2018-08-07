<?php

/**
 * Created by PhpStorm.
 * User: adbert
 * Date: 2018/8/7
 * Time: 下午2:25
 */
class QueryFlightManager
{
    use ClientTrait;

    const URL = 'https://helloticket.com/query';

    protected $origin;
    protected $destination;
    protected $date;

    /**
     * OrderManager constructor.
     * @param $origin
     * @param $destination
     * @param $date
     */
    public function __construct($origin, $destination, $date)
    {
        $this->origin = $origin;
        $this->destination = $destination;
        $this->date = $date;
    }

    public function store()
    {
        try {
            $responseData = $this->request(
                'post',
                static::URL,
                [
                    'origin' => $this->origin,
                    'destination' => $this->destination,
                    'date' => $this->date
                ]
            );

            return [
                'origin' => $responseData['origin'],
                'destination' => $responseData['destination'],
                'datetime' => date('Y-m-d H:i:s', $responseData['datetime']),
                'duration' => $responseData['duration'],
                'airline' => $responseData['airline'],
                'flightNumber' => $responseData['flightNumber'],
            ];

        } catch (\Exception $e) {
            return false;
        }
    }
}