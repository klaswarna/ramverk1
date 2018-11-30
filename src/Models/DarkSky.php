<?php

namespace KW\Models;

class DarkSky
{
    /**
     * Return a weather forecast from DarkSky
     *
     * @return json
     */

    public function __construct($di)
    {
        $this->di = $di;
        $this->darkSkyKey = $this->di->get("apikeys")["config"]["darkSky"];
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
                $result["error"] = "något blev fel";
                $result["daily"]["data"][0] = "no info";
                $result = json_decode(json_encode($result));
            }
            return $result;
        } else {
            $multi = new MultiCURL($this->di);

            $result = $multi->multicurla($longitude, $latitude);
            return $result;
        }
    }
}
