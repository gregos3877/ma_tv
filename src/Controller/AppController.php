<?php

namespace App\Controller;

use App\Entity\Chaine;
use App\Entity\Tv;
use App\Form\ChaineType;
use App\Message\MyMessage;
use App\Message\RechercheChaineMessage;
use App\Repository\ChaineRepository;
use App\Utils\ApiData;
use App\Utils\ChaineFounder;
use App\Utils\DataApi;
use App\Utils\GetDataChaine;
use App\Utils\RecuperationContenuChaine;
use App\Utils\UnService;
use App\Utils\VerifDirectChaine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(VerifDirectChaine $verif)
    {

        return $this->render('app/index.html.twig', [
        ]);
    }

    /**
     * @Route("/tv/{id}", name="view_tv")
     */
    public function viewTv(Tv $tv)
    {

        return $this->render('app/view_tv.html.twig', [
            'tv' => $tv,
        ]);
    }

    /**
     * @Route("/aaa", name = "ma_fonctio")
     */
    public function maFonction(Request $request, DataApi $dataApi)
    {
        $form = $this->createForm(ChaineType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $nom = $form->getData()->getNomChaine();
            $plateform = $form->getData()->getPlateform();
            $nomPlateform = $form->getData()->getPlateform()->getNomPlateform();

            dump($nomPlateform, $nom, $plateform);


//            $data = $dataApi->getDataFromApi($nom);


        }
        return $this->render('app/ma_fonction.html.twig', [
            'form' => $form->createView(),
        ]);

    }






//    /**
//     * @Route("/aaa", name="ma_fonctio")
//     */
//    public function maFonction(GetDataChaine $dataChaine, RecuperationContenuChaine $recup, ChaineRepository $chaineRepository, UnService $unService, EventDispatcherInterface $eventDispatcher)
//    {
//        dump("Début Controller");
//
////        $unService;
//
//        $res = "ok";
//
//        $event = new GenericEvent();
//
//
//
//
////        $chaine = $chaineRepository->find(2);
////        dump($chaine);
//
////        $clientId = "2369d28d-b4dd-482d-b638-b4152c06cdf6";
////        $url = "https://api.fortnitetracker.com/v1/profile/account/06b47aeb-b8ad-40b1-b818-e49fb50c871e/matches";
////        $url = "https://api.fortnitetracker.com/v1/profile/pc/Solary Hunter";
////        $url = "https://api.twitch.tv/helix/streams?user_id=24147592";
//
////        id gotaga = 24147592
////        id mistermv = 28575692
//
////        $clientId = "AIzaSyDC6C9H5Ie9l-WQLpqmwStv3uph9WG4Wjw";
////
////        $url = "https://www.googleapis.com/youtube/v3/channels?part=snippet&forUsername=gotag4&key=".$clientId;
////        $ch = curl_init($url);
////
////        curl_setopt_array($ch, [
//////            CURLOPT_HTTPHEADER => ['Api-Key: ' . $clientId],
////            CURLOPT_RETURNTRANSFER => true,
////        ]);
////
////        $res = curl_exec($ch);
////        curl_close($ch);
//////        dump($res);
////        dump(json_decode($res));
//
//
//        return $this->render('app/ma_fonction.html.twig', [
//            'res' => $res,
////            'liste' => $liste,
//        ]);
//    }


}
