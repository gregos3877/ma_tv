<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 19/03/19
 * Time: 12:39
 */

namespace App\Utils;


use App\Entity\Chaine;

class VerifDirectChaine
{


    public function estEnDirect(Chaine $chaine)
    {
        

        $clientId = "7b3fiiiemhuj0065d2fdilgdjrmhi6";
//        $url = "https://api.twitch.tv/helix/users?login=mistermv";
        $url = "https://api.twitch.tv/helix/streams?user_id=24147592";

//        id gotaga = 24147592
//        id mistermv = 28575692

        $ch = curl_init($url);
        curl_setopt_array($ch, [CURLOPT_HTTPHEADER => ['Client-ID: ' . $clientId],
            CURLOPT_RETURNTRANSFER => true]);

        $page_content = curl_exec($ch);

        curl_close($ch);


        $liste = json_decode($page_content);


        return count($liste->data);
    }

}
