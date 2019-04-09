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
use App\Repository\ChaineRepository;
use App\Utils\ChaineFounder;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RechercheChaineMessageHandler implements MessageHandlerInterface
{

    private $chaineFounder;
    private $chaineRepository;

    public function __construct(ChaineRepository $chaineRepository, ChaineFounder $chaineFounder)
    {
        $this->chaineFounder = $chaineFounder;
        $this->chaineRepository = $chaineRepository;
    }

    // Utilise le service chaineFounder affin de trouvé un chaine en bdd ou sur le net
    public function __invoke(RechercheChaineMessage $message)
    {
//        dump("rechercheMesage");
        $chaine = $this->chaineRepository->findOneBy(['nomChaine' => $message->getNom()]);
//        dump($chaine);

//        $this->chaineFounder->find($message->getNom(), $message->getPlateform());
        // Doit retouré un chaine valide ou null
        return $chaine;
    }

}