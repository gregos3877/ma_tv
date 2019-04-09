<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 19/03/19
 * Time: 12:39
 */

namespace App\Utils;


use App\Entity\Chaine;

class GetDataChaine
{
    private $dataChaine;


    public function rechercheChaineTwitch(Chaine $chaine)
    {
        $clientId = "7b3fiiiemhuj0065d2fdilgdjrmhi6";
        $url = "https://api.twitch.tv/helix/users?login=" . $chaine->getNomChaine();
        dump($url);
        $ch = curl_init($url);
        curl_setopt_array($ch, [CURLOPT_HTTPHEADER => ['Client-ID: ' . $clientId],
            CURLOPT_RETURNTRANSFER => true]);

        $page_content = curl_exec($ch);

        curl_close($ch);

//        dump($page_content);

        if (strlen($page_content) == 11) return null;

        $this->dataChaine = $page_content ;

    }

    // Retourne une chaine en json
    public function getDataChaine()
    {
        return $this->dataChaine;
    }


}
