<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 01/04/19
 * Time: 13:20
 */

namespace App\Utils;


class DataApiFounder
{
    private $url;
    private $param;

    public function __construct(string $url, string $param = null)
    {
        $this->url = $url;
        $this->param = $param;
        dump("Creation apiDataFondzer pour ");
    }

    public function getDataApi()
    {
        $curl = curl_init($this->url);

        if ($this->param != null) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->param);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($curl);


        curl_close($curl);

        dump(json_decode($res));

        return json_decode($res);

    }

    public function getDataApi2()
    {

    }

}