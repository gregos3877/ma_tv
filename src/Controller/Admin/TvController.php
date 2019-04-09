<?php

namespace App\Controller\Admin;

use App\Entity\Chaine;
use App\Entity\ContenuDiffuse;
use App\Entity\Plateform;
use App\Entity\Tv;
use App\Entity\User;
use App\Event\RechercheEvent;
use App\Events;
use App\Form\ChaineType;
use App\Form\TvType;
use App\Message\RechercheChaineMessage;
use App\MessageHandler\RechercheChaineMessageHandler;
use App\Repository\ChaineRepository;
use App\Repository\ContenuDiffuseRepository;
use App\Utils\ChaineFounder;
use App\Utils\RechercheChaine;
use App\Utils\RechercheChaineNet;
use App\Utils\UnService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\Stamp\ReceivedStamp;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Workflow\Registry;

/**
 * @Route("/admin/matv")
 * @IsGranted("ROLE_CREATEUR")
 *
 */
class TvController extends AbstractController
{

    /**
     * @Route("/", name="ma_tv")
     */
    public function index(ContenuDiffuseRepository $cd): Response
    {
        $listeChaineTv = $cd->findBy(['Tv' => $this->getUser()->getTv()]);

        return $this->render('admin/tv/index.html.twig', [
            'listeChaineTv' => $listeChaineTv,
        ]);
    }

    /**
     * @Route("/ajouterChaineTV", name="ajouter_chaine_tv")
     */
    public function ajouterChaineTv(Request $request, ChaineRepository $chaineRepository)
    {
        $form = $this->createFormBuilder()->add('plateform', EntityType::class, [
            'class' => Plateform::class,
            'choice_label' => 'nomPlateform',
        ])
            ->add('nomChaine')
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $chaine = $chaineRepository->findOneBy(['nomChaine' => $data['nomChaine'], 'plateform' => $data['plateform']]);
            dump($chaine);

            if (!$chaine) {
//                throw $this->createNotFoundException('La chaine est pas dans la bdd');
            }
        }

        return $this->render('tv/ajouter_chaine_tv.html.twig', [
            'form'  => $form->createView(),
        ]);
    }

//
//    /**
//     * Finds and displays a Post entity.
//     *
//     * @Route("/{id<\d+>}", methods={"GET"}, name="admin_post_show")
//     */
//    public function show(Post $post): Response
//    {
//        // This security check can also be performed
//        // using an annotation: @IsGranted("show", subject="post", message="Posts can only be shown to their authors.")
//        $this->denyAccessUnlessGranted('show', $post, 'Posts can only be shown to their authors.');
//
//        return $this->render('admin/blog/show.html.twig', [
//            'post' => $post,
//        ]);
//    }


    /**
     * Rechercher une chaine en BDD en premier puis sur le web
     *
     * @Route("/rechercheChaine", name="rechercher_chaine")
     */
    public function rechercheChaine(Request $request, MessageBusInterface $bus): Response
    {

//        $data = $request->get('chaine');
//        dump($data);

//        $chaine = new Chaine();
        $formChaine = $this->createForm(ChaineType::class);
        $formChaine->handleRequest($request);


        // Affichage de la chaine rechercher ou message aucune chaine trouvée
        if ($formChaine->isSubmitted() && $formChaine->isValid()) {


//            dump("Click sur bouton rechercher");

            $data = $formChaine->getData();
//            dump($data);
            $enveloppe = $bus->dispatch(new RechercheChaineMessage($data->getNomChaine(), $data->getPlateform()->getNomPlateform()));
            dump($enveloppe);
//            foreach ($enveloppe->all(HandledStamp::class) as $handle)
//            {
//                if ($handle->getCallableName() == RechercheChaineMessageHandler::class.'::__invoke') {
//                    $chaine = $handle->getResult();
//                }
//            }
            dump($enveloppe->last(HandledStamp::class)->getResult());
//            $chaine = $chaineRepository->find(1);
//            $chaine = null;
//            dump($chaineARechercher);

            $chaine = "";


            return $this->render('tv/rechercher_chaine2.html.twig', [
                'form' => $formChaine->createView(),
//                'chaine' => $chaine,
            ]);
//
        }

        return $this->render('tv/rechercher_chaine2.html.twig', [
            'form' => $formChaine->createView(),
        ]);
    }

//    /**
//     * @Route("", name="")
//     */
//    public function addChaineTv(Request $request)
//    {
//
//
//    }

//    /**
//     * Rechercher une chaine en BDD en premier puis sur le web
//     *
//     * @Route("/rechercheChaine", name="rechercher_chaine")
//     */
//    public function rechercheChaine(Request $request, EventDispatcherInterface $eventDispatcher): Response
//    {
//
//        $formChaine = $this->createForm(ChaineType::class);
//        $formChaine->handleRequest($request);
//
//        // Affichage de la chaine rechercher ou message aucune chaine trouvée
//        if ($formChaine->isSubmitted() && $formChaine->isValid()) {
////
////            $plateform = $formChaine->getData()->getPlateform();
////            $nomChaine = $formChaine->getData()->getNomChaine();
////            dump($plateform, $nomChaine);
//
//            // Rechercher une chaine avec le nom {$nomChaine} sur la plateform {$plateform}
//            // Retourne une chaine ou null
//
////            $chaine = $chaineFounder->findChaine($nomChaine, $plateform);
//
////            dump($chaine);
//
//            $event = new RechercheEvent($formChaine->getData());
//
//            dump("Chaine avant dispatch",$event->getChaine());
//
//            $eventDispatcher->dispatch(RechercheEvent::NAME, $event);
//
//            $chaine = $event->getChaine();
//
//            dump("Chaine apres dispatch",$event->getChaine());
//
//
//            return $this->render('tv/rechercher_chaine.html.twig', [
//                'form' => $formChaine->createView(),
//                'chaine' => $chaine,
//            ]);
//
//        }
//
//        return $this->render('tv/rechercher_chaine.html.twig', [
//            'form' => $formChaine->createView(),
//        ]);
//    }


    /**
     * @Route("/show", name="show_ma_tv")
     */
    public function showMaTv()
    {
        $tv = $this->getUser()->getTv();

        return $this->render('tv/show_ma_tv.html.twig', [
            'tv' => $tv,
        ]);

    }

    /**
     * @Route("/showTv", name="show_tv")
     */
    public function showTv()
    {
        $tv = $this->getUser()->getTv();

        return $this->render('tv/show_tv.html.twig', [
            'tv' => $tv,
        ]);
    }


    /**
     * Cette function est appelé directement via un renderController dans tv/rechercher_chaine.html.twig.
     * Elle n'a donc pas besoin de route
     */
    public function showChaine($chaine)
    {
        $contenus = $chaine->getContenuDiffuses();

        foreach ($contenus as $item) {
            if ($item->getTv() == $this->getUser()->getTv()) {
//                dump("La chaine est deja sur la tv");
                return $this->render('tv/show_chaine.html.twig');
            }
        }

        return $this->render('tv/show_chaine.html.twig', ['chaine' => $chaine]);
    }


    /**
     * @Route("/ajouterChaine/{chaine}", name="ajouter_chaine")
     */
    public function newChaineTv(Request $request, Chaine $chaine): Response
    {

        // Prevoir des verifications si deja sur la chaine par exemple ...

        $chaineTv = new ContenuDiffuse();
        $chaineTv->setChaine($chaine);
        $chaineTv->setTv($this->getUser()->getTv());

        $em = $this->getDoctrine()->getManager();
        $em->persist($chaineTv);
        $em->flush();

        return $this->redirectToRoute('ma_tv');

    }

    /**
     * Remove a chaien from a Tv.
     *
     * @Route("/remove/{id}", name="chaine_tv_remove")
     */
    public function removeChaineTv(Request $request, ContenuDiffuse $contenuDiffuse): Response
    {
        $tv = $this->getUser()->getTv();

        $em = $this->getDoctrine()->getManager();
        $em->remove($contenuDiffuse);
        $em->flush();

        dump($contenuDiffuse);


        return $this->redirectToRoute('ma_tv');


    }


    /**
     * @Route("/edit", name="edit_tv")
     */
    public function editTv(Request $request): Response
    {

        $tv = $this->getUser()->getTv();
        $form = $this->createForm(TvType::class, $tv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tv);
            $em->flush();

            return $this->redirectToRoute('show_ma_tv');
        }
        return $this->render('tv/edit_tv.html.twig', [
            'form' => $form->createView()
        ]);
    }

//    /**
//     * Rechercher une chaine en BDD en premier puis sur le web
//     *
//     * @Route("/rechercheChaine2", name="rechercher_chaine2")
//     */
//    public function rechercheChaine2(Request $request, EventDispatcherInterface $eventDispatcher, RechercheChaineNet $rechercheChaine): Response
//    {
//        $chaineARechercher = new Chaine();
//
//        $formChaine = $this->createForm(ChaineType::class, $chaineARechercher);
//        $formChaine->handleRequest($request);
//
//        // Affichage de la chaine rechercher ou message aucune chaine trouvée
//        if ($formChaine->isSubmitted() && $formChaine->isValid()) {
//
//
//            $event = new RechercheEvent($chaineARechercher);
//            $eventDispatcher->dispatch(RechercheEvent::NAME, $event);
//
//            $chaine = $event->getChaine();
//
//            return $this->render('tv/rechercher_chaine.html.twig', [
//                'form' => $formChaine->createView(),
//                'chaine' => $chaine,
//            ]);
//
//        }
//
//        return $this->render('tv/rechercher_chaine.html.twig', [
//            'form' => $formChaine->createView(),
////            'chaine' => $chaine,
//        ]);
//    }
}
