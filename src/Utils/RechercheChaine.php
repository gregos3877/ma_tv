<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 19/03/19
 * Time: 12:39
 */

namespace App\Utils;

use App\Entity\Chaine;
use App\Event\AfterRechercheChaineEvent;
use App\Event\BeforeRechercheChaineEvent;
use App\Repository\ChaineRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class RechercheChaine
{
    private $chaineRepository;
    private $entityManager;
    private $chaine;

    public function __construct(ChaineRepository $chaineRepository, EntityManagerInterface $entityManager)
    {
        $this->chaineRepository = $chaineRepository;
        $this->entityManager = $entityManager;
    }


    /*
     * Retourne une chaine si trouvée ou null
     */
    public function recherche(Chaine $chaine)
    {
        if ($chaine->getPlateform()->getNomPlateform() == "Youtube") {
            dump("recherche chaine Youtube");
            $res = $this->rechercheChaineYoutube($chaine);
            dump($res);
        } elseif ($chaine->getPlateform()->getNomPlateform() == "Twitch") {
//                dump("recherche chaine txitch");
            $res = $this->rechercheChaineTwitch($chaine);
//                dump($res);
        }


        if ($res) {
            dump("Nouvelle Chaine trouvée");

            $chaine->setLienChaine($chaine->getPlateform()->getLienPlateform() . "/" . $chaine->getNomChaine());

            $this->entityManager->persist($chaine);
            $this->entityManager->flush();


        } else {
//                dump("Aucune chainte troubée");
        }
//        }

        if ($chaine->getId() != null) {
            return $chaine;
        }
        return null;
    }

    private function rechercheChaineYoutube($chaine)
    {
//        dump("rechercheYoutube");
        $url = "https://www.youtube.com/user/" . $chaine->getNomChaine();

        $ch = curl_init($url);
        curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true]);

        $page_content = curl_exec($ch);

        // Vérification du code d'état HTTP
        if (!curl_errno($ch)) {
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:  # OK

                    break;
                default:
                    curl_close($ch);
                    echo 'Unexpected HTTP code: ', $http_code, "\n";
                    return null;
            }
        }

        curl_close($ch);

//        dump($page_content);

        $start = strpos($page_content, '<meta property="og:image" content="') + 35;
        dump($start);

        $length = strpos($page_content, '"', $start) - $start;
        dump($length);


        $lienImage = substr($page_content, $start, $length);


        dump($lienImage);


        $image = file_get_contents($lienImage);

        $nomImage = md5(uniqid($chaine->getNomChaine()));

        file_put_contents("/opt/www/ma_tv/public/assets/img/chaine/Youtube/" . $nomImage, $image);
//        file_put_contents("/opt/www/ma_tv/public/assets/img/chaine/test", $page_content);


        $chaine->setImageChaine($nomImage);

        return $chaine;

    }

    private function channelsListById($service, $part, $params)
    {
        $params = array_filter($params);
        $response = $service->channels->listChannels(
            $part,
            $params
        );

        print_r($response);
    }

    /**
     * @param $chaine
     * @return bool|string
     */
    private function rechercheChaineTwitch(Chaine $chaine)
    {
//        dump("rechercheTwitc");

        $clientId = "7b3fiiiemhuj0065d2fdilgdjrmhi6";
        $url = "https://api.twitch.tv/helix/users?login=" . $chaine->getNomChaine();

        $ch = curl_init($url);
        curl_setopt_array($ch, [CURLOPT_HTTPHEADER => ['Client-ID: ' . $clientId],
            CURLOPT_RETURNTRANSFER => true]);

        $page_content = curl_exec($ch);

        curl_close($ch);

//        dump($page_content);

        if (strlen($page_content) == 11) return null;


        $start = strpos($page_content, "profile_image_url\":\"") + 20;
//        dump($start);

        $length = strpos($page_content, '"', $start) - $start;
//        dump($length);


        $lienImage = substr($page_content, $start, $length);


//        dump("lienImage :",$lienImage);


        $image = file_get_contents($lienImage);

        $nomImage = md5(uniqid($chaine->getNomChaine()));

        file_put_contents("/opt/www/ma_tv/public/assets/img/chaine/Twitch/" . $nomImage, $image);


        $chaine->setImageChaine($nomImage);
        return $chaine;
    }

    public function getChaine()
    {
        return $this->chaine;
    }

}
