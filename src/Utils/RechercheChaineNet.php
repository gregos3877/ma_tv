<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 19/03/19
 * Time: 12:39
 */

namespace App\Utils;


use App\Entity\Chaine;

class RechercheChaineNet
{
    private $chaine;
    private $apiData;

    public function __construct(APIData $APIData)
    {
        $this->apiData = $APIData;
    }


    public function rechercheChaineNet(Chaine $chaine)
    {

        dump("Bienvenue sur le chercheuur");

        if ($chaine->getPlateform()->getNomPlateform() == "Youtube") {
            $this->rechercheSurYoutube($chaine);

        } elseif ($chaine->getPlateform()->getNomPlateform() == "Twitch") {
            $this->rechercheSurTwitch($chaine);
        }
    }

    private function rechercheSurYoutube(Chaine $chaine)
    {
//        $url = "https://www.youtube.com/user/" . $chaine->getNomChaine();

        $url = "https://www.googleapis.com/youtube/v3/channels?part=snippet&forUsername=".$chaine->getNomChaine()."&key=AIzaSyDC6C9H5Ie9l-WQLpqmwStv3uph9WG4Wjw";

        $this->apiData->getAPIData($url);


//        $ch = curl_init($url);
//        curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true]);

//        $page_content = curl_exec($ch);

        // Vérification du code d'état HTTP
//        if (!curl_errno($ch)) {
//            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
//                case 200:  # OK
//
//                    break;
//                default:
//                    curl_close($ch);
////                    echo 'Unexpected HTTP code: ', $http_code, "\n";
//                    return null;
//            }
//        }

//        curl_close($ch);

//        dump($page_content);
    }

    private function rechercheSurTwitch(Chaine $chaine)
    {
        dump("Recherche sur twitch");


        $clientId = "7b3fiiiemhuj0065d2fdilgdjrmhi6";
        $url = "https://api.twitch.tv/helix/users?login=" . $chaine->getNomChaine();

        $ch = curl_init($url);
        curl_setopt_array($ch, [CURLOPT_HTTPHEADER => ['Client-ID: ' . $clientId],
            CURLOPT_RETURNTRANSFER => true]);

        $page_content = curl_exec($ch);
        $res = json_decode($page_content);

        curl_close($ch);
        dump($res->data);


        if (count($res->data) > 0) {
            dump("Chaine twitch trouvée");
            dump($chaine);
        }

//        dump(count($res));




    }

    public function getChaine()
    {
        return $this->chaine;
    }


}
