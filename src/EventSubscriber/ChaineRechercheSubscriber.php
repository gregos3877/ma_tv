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
use App\Utils\DataApiFounder;
use App\Utils\RechercheChaineNet;
use App\Utils\UrlCurlGenerator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ChaineRechercheSubscriber implements EventSubscriberInterface
{
    private $chaineRepository;
    private $chercheur;
    private $url;

    public function __construct(ChaineRepository $chaineRepository, UrlCurlGenerator $urlCurlGenerator)
    {
        $this->chaineRepository = $chaineRepository;
        $this->url = $urlCurlGenerator;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Events::RECHERCHE_CHAINE => [
                ['rechercheSurWeb', 0],
                ['rechercheEnBdd', 5],
            ],
//            KernelEvents::RESPONSE => [
//                ['onKernelResponse']
//            ]
        ];
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = $event->getResponse();
        dump($event);
    }

    public function rechercheEnBdd(RechercheEvent $event): void
    {
        dump("RechercheEnBDD");
        $chaine = $this->chaineRepository->findOneBy(['nomChaine' => $event->getChaine()->getNomChaine(), 'plateform' => $event->getChaine()->getPlateform()]);

        if ($chaine) {
            dump("stopPropa");
            $event->setChaine($chaine);
            $event->stopPropagation();
        }
    }

    public function rechercheSurWeb(RechercheEvent $event): void
    {
        dump("recherche de la chaine ".$event->getChaine()->getNomChaine()." sur la plateform ".$event->getChaine()->getPlateform()->getNomPlateform());

//        dump($event->getChaine());

//        $url = $event->getChaine()->getPlateform()->getLienPlateform();

//        $param = "";
//        if ($event->getChaine()->getPlateform()->)

//        $dataApiFounder = new DataApiFounder();

//        $data = $dataApiFounder->getDataApi();


//        $url = $event->getChaine()->getPlateform()->getLienPlateform();


//        $dataChaine = new DataApiFounder();

//        $this->chercheur->rechercheChaineNet($event->getChaine());
//
//        if ($this->chercheur->getChaine()) {
//            $event->setChaine($chaine);
//            $event->stopPropagation();
//        }

    }

}