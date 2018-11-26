<?php

namespace KW\Models;

class DarkSky
{
    /**
     * Return a weather forecast from DarkSky
     *
     * @return json
     */
    public function weather($longitude, $latitude)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.darksky.net/forecast/8fc8b212a2c3531bdd01693e25e1442f/"
        . $latitude . "," . $longitude . "?lang=sv&units=si");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result);

        return $result;
    }
}



// https://api.darksky.net/forecast/8fc8b212a2c3531bdd01693e25e1442f/55.72927,13.20621?lang=sv&units=si


//fixa get koord, get type (framtid eller baktid),
