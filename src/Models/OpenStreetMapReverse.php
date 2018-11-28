<?php

namespace KW\Models;

class OpenStreetMapReverse
{
    /**
     * Return adress from coordinates
     *
     * @return array
     */

    public function __construct()
    {
        $this->apiKeys = new \KW\config\ApiKeys;
        $this->accessKey = $this->apiKeys->openStreetMap;
        $this->baseUrl = "https://nominatim.openstreetmap.org/reverse?";
    }


    public function osmCheckCoordinates($longitude, $latitude)
    {
        $url = ($this->baseUrl . $this->accessKey . "&format=json&lat=" . $latitude . "&lon=" . $longitude . "&addressdetails=1");
        $cURL = new CURL;
        $result = $cURL->req($url);
        $result = json_decode($result);

        $country = $result->address->country ?? "";
        $town = $result->address->town ?? "";

        return array($country, $town);
    }
}
