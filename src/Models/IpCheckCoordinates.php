<?php

namespace KW\Models;

class IpCheckCoordinates
{
    /**
     * Check ip-type
     *
     * @return array
     */

    public function __construct($di)
    {
        $this->di = $di;
        //$this->ipCheckKey = $this->apiKeys->ipCheck;
        $this->baseUrl = "http://api.ipstack.com/";
        $this->apiKeys = $this->di->get("apikeys")["config"]["ipCheck"];
    }

    /**
     * Check ip-type
     *
     * @return array containing coordinates, country and town for IP if available
     */
    public function ipCheckCoordinates(string $ipnumber)
    {
        $accessKey = $this->apiKeys;
        $url = ($this->baseUrl . $ipnumber . "?access_key=" . $accessKey);

        $cURL = new CURL;
        $result = $cURL->req($url);
        $result = json_decode($result);

        return array($result->latitude, $result->longitude, $result->country_name, $result->city);
    }
}
