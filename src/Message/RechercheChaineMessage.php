<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 01/04/19
 * Time: 12:20
 */

namespace App\Message;


class RechercheChaineMessage
{
    private $nom;
    private $plateform;


    public function __construct(string $nom, string $plateform)
    {
        $this->nom = $nom;
        $this->plateform = $plateform;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPlateform()
    {
        return $this->plateform;
    }


}