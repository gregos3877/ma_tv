<?php

namespace App\Controller;

use App\Entity\Chaine;
use App\Entity\ContenuDiffuse;
use App\Entity\Tv;
use App\Entity\User;
use App\Events;
use App\Form\ChaineType;
use App\Form\TvType;
use App\Repository\ChaineRepository;
use App\Repository\ContenuDiffuseRepository;
use App\Utils\RechercheChaine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/matv/chaine")
 * @IsGranted("ROLE_CREATEUR")
 *
 */
class ChaineController extends AbstractController
{


    /**
     * @Route("/{chaine}", defaults={"chaine": "null", "_format"="html"}, name="view_recherche_chaine")
     */
    public function viewRechercheChaine(Request $request, Chaine $chaine = null)
    {
        $chaine = new Chaine();
        $formChaine = $this->createForm(ChaineType::class, $chaine);
        $formChaine->handleRequest($request);


        // Affichage de la chaine rechercher ou message aucune chaine trouvée
        if ($formChaine->isSubmitted() && $formChaine->isValid()) {
            dump("Click sur bouton rechercher");

        }

        return $this->render('chaine/view_recherche_chaine.html.twig', [
            'chaine' => $chaine,
        ]);

    }

    public function formRechercheChaine()
    {
        $form = $this->createForm(ChaineType::class);

        return $this->render('chaine/_recherche_chaine_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
