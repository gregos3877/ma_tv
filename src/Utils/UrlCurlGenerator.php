<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 01/04/19
 * Time: 14:32
 */

namespace App\Utils;


class UrlCurlGenerator
{
    public function generateUrlCurl(string $lien, string $nom, string $key = null)
    {
        return $lien.$nom.$key;
    }

}