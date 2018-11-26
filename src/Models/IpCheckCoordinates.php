<?php

namespace KW\Models;

class IpCheckCoordinates
{
    /**
     * Check ip-type
     *
     * @return array
     */
    public function ipCheckCoordinates(string $ipnumber)
    {
        require 'access_key.php'; //laddar $access_key med hemlig nyckel som inte läggs ut
        $accessKey = $accessKey; //för att lura validatorn
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://api.ipstack.com/" . $ipnumber . "?access_key=" . $accessKey);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($result);

        return array($result->latitude, $result->longitude, $result->country_name, $result->city);
    }
}


/* om man skulle vilja kolla post
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "postvar1=value1&postvar2=value2&postvar3=value3");
*/
