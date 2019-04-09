<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 19/03/19
 * Time: 12:39
 */

namespace App\Utils;

use App\Repository\PlateformRepository;

class DataApi
{
    private $url;
//    private $param;

    public function __construct(UrlCurlGenerator $url)
    {
        $this->url = $url;
//        $this->param = $param;
    }


    public function getDataFromApi(string $nom)
    {
        $ch = curl_init($this->url->generateUrlCurl());

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//        if ($this->$param) {
//            curl_setopt($ch, CURLOPT_HTTPHEADER, $param);
//        }

        $res = curl_exec($ch);

        curl_close($ch);

        return json_decode($res);

    }

}
