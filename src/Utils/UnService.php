<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 19/03/19
 * Time: 12:39
 */

namespace App\Utils;

class UnService
{

    public function __construct()
    {
        dump("1 - Constructeur UnService");
    }

    public function uneFonctionDuService()
    {
        dump("uneFonctionDuService");
    }

    public function uneFonctionAvecParametreDuService(string $param1)
    {
        dump("uneFonctionAvecParametreDuService");
    }


}
