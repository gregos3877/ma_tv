<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 19/03/19
 * Time: 13:08
 */

namespace App\Event;


use App\Entity\Chaine;
use Symfony\Component\EventDispatcher\Event;

class RechercheEvent extends Event
{

    public const NAME = 'recherche.chaine';

    protected $chaine;

    public function __construct(Chaine $chaine)
    {
        $this->chaine = $chaine;
    }

    public function getChaine()
    {
        return $this->chaine;
    }

    public function setChaine(Chaine $chaine)
    {
        $this->chaine = $chaine;
    }
}