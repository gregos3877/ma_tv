<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 03/04/19
 * Time: 13:05
 */

namespace App\Middleware;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface as Middleware;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class RechercheChaineMiddleware implements Middleware
{

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {

        $handler = null;

        $message = $envelope->getMessage();

//        $envelope->with(HandledStamp::fromCallable($handler, $handler($message), \is_string($alias)))


        return $stack->next()->handle($envelope, $stack);
    }
}