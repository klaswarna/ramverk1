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
            if ($result == null) {
                $result["error"] = "kuken";
                $result["daily"]["data"][0] = "no info";
                $result = json_decode(json_encode($result));

            }
            return $result;
        } else {
            $multi = new MultiCurl;

            $result = $multi->multicurla($longitude, $latitude);
            return $result;

        }
    }
}
