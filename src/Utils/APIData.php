<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 19/03/19
 * Time: 12:39
 */

namespace App\Utils;

class APIData
{

    // $url represente une chaine avec l'url de lapi a contacté
    // $optHeader est une chaine sous la forme ['{IdentifieurKey}: ' . {Key}]

    public function getAPIData($url, $optHeader=null)
    {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if ($optHeader != null) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $optHeader);
        }

        $res = curl_exec($curl);

        curl_close($curl);

        dump($res);
        return json_decode($res);
    }

}
