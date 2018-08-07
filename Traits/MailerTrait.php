<?php

/**
 * Created by PhpStorm.
 * User: Zheyu
 * Date: 2018/8/7
 * Time: 下午2:16
 */
Trait MailerTrait
{

    /**
     * @param $email
     * @param $title
     * @param $content
     * @return mixed
     *
     * 假設 Mailer 寫法是對的，暫時不實作內容
     */
    public function send($email, $title, $content)
    {
        return (new Mailer())->send($email, $title, $content);
    }
}