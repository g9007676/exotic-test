<?php

/**
 * Created by PhpStorm.
 * User: adbert
 * Date: 2018/8/7
 * Time: 下午2:25
 */
class OrderManager
{
    use ClientTrait, MailerTrait;

    const PAY_URL = 'https://hellopay.com/pay';

    protected $orderRepository;

    /**
     * OrderManager constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    public function store($args, $creditCard, $user)
    {
        $order = new Order();
        $order = $this->orderRepository->save($args, $order);
        try {
            $this->request(
                'post',
                static::PAY_URL,
                [
                    'creditCardNo' => $creditCard['no'],
                    'amount' => $args['price'],
                    'expireDate' => $creditCard['date'],
                    'cvv' => $creditCard['cvv'],
                    'key' => 'gDJSkflsdajk34fklsd4j21kgfd'
                ]
            );

            $this->orderRepository->updateStatus(OrderRepository::PAID_STATUS, $order);
            $this->send($user['mail'], '付款成功', '您的訂單 '.$order->id.' 已付款成功');
        } catch (\Exception $e) {
            $this->orderRepository->updateStatus(OrderRepository::PAY_FAILED_STATUS, $order);
            $this->send($user['mail'], '付款失敗', '您的訂單 '.$order->id.' 付款失敗');
        }
    }
}