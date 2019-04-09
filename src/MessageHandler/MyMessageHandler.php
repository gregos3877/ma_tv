<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 01/04/19
 * Time: 12:22
 */

namespace App\MessageHandler;


use App\Message\MyMessage;
use App\Message\RechercheChaineMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class MyMessageHandler implements MessageHandlerInterface
{
    public function __invoke(RechercheChaineMessage $message)
    {
        // TODO: Implement __invoke() method.
//        dump($message);
//        $res = $message->getMessage();
//        dump("messageMy");
        return "okMessag";
    }

}