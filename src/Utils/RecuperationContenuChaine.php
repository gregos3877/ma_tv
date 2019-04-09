<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 22/03/19
 * Time: 10:45
 */

namespace App\Utils;


use App\Entity\Chaine;

class RecuperationContenuChaine
{

    public function runRecuperation(Chaine $chaine)
    {
        $listeVideo = $chaine->getPlateform()->rechercheVideo();
    }

}