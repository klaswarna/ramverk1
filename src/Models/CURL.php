<?php

namespace KW\Models;

class CURL
{
    /**
    * @var array $objekt som api:et returnerar
    */

    public function req(string $url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
}
