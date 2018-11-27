<?php

namespace KW\Models;

class DarkSky
{
    /**
     * Return a weather forecast from DarkSky
     *
     * @return json
     */

    public function __construct () {
        $this->apiKeys = new \KW\config\ApiKeys;
        $this->darkSkyKey = $this->apiKeys->darkSky;
        $this->baseUrl = "https://api.darksky.net/forecast/";
        $this->apiSettings = "?lang=sv&units=si";
    }


    public function weather($longitude, $latitude, $type)
    {
        if ($type=="future") {
            $url = ($this->baseUrl . $this->darkSkyKey . "/" . $latitude . "," . $longitude . $this->apiSettings);
            $cURL = new CURL;
            $result = $cURL->req($url);
            $result = json_decode($result);
            //echo("lonlat:" . $longitude . $latitude);
            //die;
            return $result;
        } else {
            $multi = new MultiCurl;

            $result = $multi->multicurla($longitude, $latitude);
            return $result;

            /*$result = array(
                "daily" => array(
                    "data" => array()
                )
            );
            $datum = time();
            for ($i=0; $i < 30; $i++) {
                $aktuellsekund = $datum - 30*86400 + $i*86400;
                $url = ($this->baseUrl . $this->darkSkyKey . "/" . $latitude . "," . $longitude . "," . $aktuellsekund . $this->apiSettings);
                $cURL = new CURL;
                $svar = $cURL->req($url);
                $svar = json_decode($svar);
                $result['daily']['data'][$i] = $svar->daily->data[0];
            }
            $result = json_decode(json_encode($result));
            return $result;*/
        }
    }
}
