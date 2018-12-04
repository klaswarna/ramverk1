<?php

namespace KW\Models;

class DarkSkyUmbrella
{

    /**
    * @var array $wobj array med info om ett ipnummer, koordinater samt ev väderresultat
    */

    public $wobj = array(
        "ip"=>"",
        "valid"=>false,
        "type" => "",
        "latitude" => 0,
        "longitude" => 0,
        "city"=>"",
        "country"=>"",
        "weatherresult"=>[]
    );

    public function __construct($di)
    {
        $this->di = $di;
        $this->ipValidate = new IpValidate($this->di);
        $this->ipDomainname = new IpDomainname($this->di);
        $this->ipCheckCoordinates = new IpCheckCoordinates($this->di);
        $this->osmr = new OpenStreetMapReverse($this->di);
        $this->darkSky = new DarkSky($this->di);
    }

    /**
     * Get url-type according to type and position to send to Dark Sky
     *
     * @return array
     */
    public function input($longitude, $latitude, $type, $ipn)
    {
        if (abs($longitude) >= 180 or abs($latitude) >= 90) {
            $this->wobj["error"] = "Du angav in felaktiga kooridnater!";
            return $this->wobj;
        };
        $this->wobj["type"] = $type;
        if ($ipn != "") {
            $this->wobj["valid"] = $this->ipValidate->validate($ipn);

            if ($this->wobj["valid"]) {
                list($this->wobj["latitude"], $this->wobj["longitude"],
                    $this->wobj["country"], $this->wobj["city"])
                    = $this->ipCheckCoordinates->ipCheckCoordinates($ipn);
                if ($this->wobj["country"] == "" and $this->wobj["latitude"] == 0 and $this->wobj["latitude"] == 0) {
                    $this->wobj["error"] = "Ip-adressen matchar ingen geografisk plats. Denna vädertjänst redovisar inga cyberväder";
                    return $this->wobj;
                }
            } else {
                $this->wobj["error"] = "Du angav en felaktig ip-adress!";
                return $this->wobj;
            }
        } else {
            if ($longitude == "" or $latitude == "") {
                $this->wobj["error"] = "Du måste ange korrekt longitud och latitud om ipnummer ej anges!";
                return $this->wobj;
            }
            $this->wobj["latitude"]= $latitude;
            $this->wobj["longitude"] = $longitude;
            list($this->wobj["country"], $this->wobj["city"]) = $this->osmr->osmCheckCoordinates($longitude, $latitude);
        }
        $this->wobj["weatherresult"] = $this->darkSky->weather($this->wobj["longitude"], $this->wobj["latitude"], $type);

        return $this->wobj;
    }
}
