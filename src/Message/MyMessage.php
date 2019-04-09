<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 01/04/19
 * Time: 12:20
 */

namespace App\Message;


class MyMessage
{
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }
//
//    public function setMessage(string $message)
//    {
//        $this->message = $message;
//    }



}