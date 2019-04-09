<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 18/03/19
 * Time: 11:10
 */

namespace App\EventSubscriber;

use App\Entity\Chaine;
use App\Event\RechercheEvent;
use App\Events;
use App\Repository\ChaineRepository;
use App\Utils\RechercheChaineNet;
use App\Utils\UnService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Response;

class UnEventSubscriber implements EventSubscriberInterface
{
    public $unService;

    public function __construct(UnService $unService)
    {
//        $this->unService = $unService;
//        dump("3 - constructeur UnEventSubscriber");
    }

    public static function getSubscribedEvents(): array
    {
        return [
//            Events::UN_EVENT => [
//                ['eventFonction', 10],
//                ['eventAutreFonction', 5],
//            ],
        ];
    }

    public function eventFonction(GenericEvent $event): void
    {
        dump("eventFonction");
        $this->unService->uneFonctionDuService();
    }

    public function eventAutreFonction(GenericEvent $event): void
    {
        dump("eventAutreFonction");
    }

}