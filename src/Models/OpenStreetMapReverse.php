<?php

namespace KW\Models;

class OpenStreetMapReverse
{
    /**
     * Return adress from coordinates
     *
     * @return array
     */
    public function OSMCheckCoordinates($longitude, $latitude)
    {
        $curl = curl_init();
        /*curl_setopt($curl, CURLOPT_URL, "https://nominatim.openstreetmap.org/reverse?format=json&lat="
        . $latitude . "&lon=" . $longitude . "&addressdetails=1");*/
        curl_setopt($curl, CURLOPT_URL, "https://nominatim.openstreetmap.org/reverse?email=klas.warna@gmail.com&format=json&lat="
        . "55.72" . "&lon=" . "13.20" . "&addressdetails=1");

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result);

        //echo("json svar från openstreetmapreverse: " . $result );

        return array($result->address->country, $result->address->town);
    }
}
