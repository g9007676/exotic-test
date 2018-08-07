<?php

/**
 * Created by PhpStorm.
 * User: Zheyu
 * Date: 2018/8/7
 * Time: 下午2:09
 */
Trait ClientTrait
{
    /**
     *
     * @param $method
     * @param $url
     * @param array $params
     * @return mixed
     * @throws Exception
     *
     * 有問題的地方 Client 帶入參數我覺得用 json_encode 很麻煩，可以改用 GuzzleHttp 來做
     */
    public function request($method, $url, Array $params)
    {
        $client = new Client();
        $response = $client->request(
            $method,
            $url,
            ['body' => $params]
        );

        if ($response->getStatusCode() != "200") {
            throw new Exception('Client Send Failed:' . $url);
        }

        return json_decode($response->getBody(), true);
    }
}