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

    /**
     * Get url-type according to type and position to send to Dark Sky
     *
     * @return array
     */
    public function input($longitude, $latitude, $type, $ipn)
    {
        $ipValidate = new IpValidate;
        $ipCheckCoordinates = new IpCheckCoordinates;
        $OSMR = new OpenStreetMapReverse;
        $darkSky = new DarkSky;

        if (($longitude == "" or $latitude == "") and $ipn=="") {
            $this->wobj["error"] = "Du måste ange korrekt longitud och latitud om ipnummer ej anges!";
            return $this->wobj;

        };
        if (abs($longitude) >= 180 or abs($latitude) >= 90) {
            $this->wobj["error"] = "Du angav in felaktiga kooridnater!";
            return $this->wobj;
        };
        $this->wobj["type"] = $type;
        if ($ipn != "") {

            $this->wobj["valid"] = $ipValidate->validate($ipn);

            if ($this->wobj["valid"]) {
                list($this->wobj["latitude"], $this->wobj["longitude"],
                    $this->wobj["country"], $this->wobj["city"])
                    = $ipCheckCoordinates->ipCheckCoordinates($ipn);
                    if ($this->wobj["country"] == "" and $this->wobj["latitude"] == 0 and $this->wobj["latitude"] == 0){
                        $this->wobj["error"] = "Ip-adressen matchar ingen geografisk plats. Denna vädertjänst redovisar inga cyberväder";
                        return $this->wobj;
                    }
            } else {
                $this->wobj["error"] = "Du angav en felaktig ip-adress!";
                return $this->wobj;
            }
        } else {
            $this->wobj["latitude"]= $latitude;
            $this->wobj["longitude"] = $longitude;
            list($this->wobj["country"], $this->wobj["city"]) = $OSMR->OSMCheckCoordinates($longitude, $latitude);
        }

        $this->wobj["weatherresult"] = $darkSky->weather($this->wobj["longitude"],
            $this->wobj["latitude"], $type);

        return $this->wobj;
    }
}
