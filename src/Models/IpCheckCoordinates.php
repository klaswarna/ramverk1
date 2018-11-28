<?php

namespace KW\Models;

class IpCheckCoordinates
{
    /**
     * Check ip-type
     *
     * @return array
     */

     public function __construct () {
         $this->apiKeys = new \KW\config\ApiKeys;
         $this->ipCheckKey = $this->apiKeys->ipCheck;
         $this->baseUrl = "http://api.ipstack.com/";
    }


    public function ipCheckCoordinates(string $ipnumber)
    {
        $accessKey = $this->ipCheckKey;
        $url = ($this->baseUrl . $ipnumber . "?access_key=" . $accessKey);

        $cURL = new CURL;
        $result = $cURL->req($url);
        $result = json_decode($result);

        return array($result->latitude, $result->longitude, $result->country_name, $result->city);
    }
}


/* om man skulle vilja kolla post
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "postvar1=value1&postvar2=value2&postvar3=value3");
*/
