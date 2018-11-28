<?php

namespace KW\Models;

class MultiCURL
{
    /**
    * @var array $objekt som api:et returnerar
    */


    public function __construct()
    {
        $this->apiKeys = new \KW\config\ApiKeys;
        $this->darkSkyKey = $this->apiKeys->darkSky;
        $this->baseUrl = "https://api.darksky.net/forecast/";
        $this->apiSettings = "?lang=sv&units=si";
    }


    public function multicurla($latitude, $longitude)
    {
        $result = array(
            "daily" => array(
                "data" => array()
            )
        );
        $chh = [];
        $datum = time();

        // create all cURL resources
        for ($i=0; $i < 30; $i++) {
            $chh[$i] = curl_init();
        }

        // set URL and other appropriate options
        for ($i=0; $i < 30; $i++) {
            $aktuellsekund = $datum - 30*86400 + $i*86400;
            $url = ($this->baseUrl . $this->darkSkyKey . "/" . $latitude . "," . $longitude . "," . $aktuellsekund . $this->apiSettings);
            // create all cURL resources
            curl_setopt($chh[$i], CURLOPT_URL, $url);
            curl_setopt($chh[$i], CURLOPT_HEADER, 0);
            curl_setopt($chh[$i], CURLOPT_RETURNTRANSFER, 1);
        }

        //create the multiple cURL handle
        $mhh = curl_multi_init();

        //add the handles
        for ($i=0; $i < 30; $i++) {
            curl_multi_add_handle($mhh, $chh[$i]);
        }

        // execute the handles
        $running = null;
        do {
            curl_multi_exec($mhh, $running);
        } while ($running > 0);


        foreach ($chh as $id => $c) {
            $svar[$id] = curl_multi_getcontent($c);
            $svar[$id] = json_decode($svar[$id]);
            curl_multi_remove_handle($mhh, $c);
        }

        curl_multi_close($mhh);

        for ($i=0; $i < 30; $i++) {
            if (isset($svar[$i]->daily->data[0])) {
                $result['daily']['data'][$i] = $svar[$i]->daily->data[0];
            } else {
                $result['daily']['data'][$i] = "Historisk väderdata över aktuell plats och tid verkar ej vara tillgänglig";
                //exit("Historisk väderdata över aktuell plats och tid verkar ej vara tillgänglig");
            }
        }
        $result = json_decode(json_encode($result));
        return $result;
    }
}
