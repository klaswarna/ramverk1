<?php

namespace KW\Models;

class DarkSkyUmbrella
{

    /**
    * @var array $ipobjekt array med info om ett ipnummer
    */

    public $weatherobject = array(
        "ip"=>"",
        "valid"=>false,
        "type" => "",
        "latitude" => 0,
        "longitude" => 0,
        "city"=>"",
        "country"=>"",
        "weatherresult"=>[]
    );

    protected $ipValidate;
    protected $ipType;
    protected $ipCheckCoordinates;
    protected $OSMR;
    protected $darkSky;

    public function __construct()
    {
        $this->ipValidate = new IpValidate;
        $this->ipType = new IpType;
        $this->ipCheckCoordinates = new IpCheckCoordinates;
        $this->OSMR = new OpenStreetMapReverse;
        $this->darkSky = new DarkSky;
    }


    /**
     * Get url-type according to type and position to send to Dark Sky
     *
     * @return array
     */
    public function input($longitude, $latitude, $type, $ipn)
    {
        if (($longitude == "" or $latitude == "") and $ipn=="") {
            exit("Du måste mata in longitud och latitud!");
        };
        if (abs($longitude) >= 180 or abs($latitude) >= 90) {
            exit("Du matade in en felaktiga kooridnater!");
        };
        $this->weatherobject["type"] = $type;
        if ($ipn != "") {
            $this->weatherobject["valid"] = $this->ipValidate->validate($ipn);    
            if ($this->weatherobject["valid"]) {
                list($this->weatherobject["latitude"], $this->weatherobject["longitude"],
                    $this->weatherobject["country"], $this->weatherobject["city"])
                    = $this->ipCheckCoordinates->ipCheckCoordinates($ipn);
                    if ($this->weatherobject["country"] == "" and $this->weatherobject["latitude"] == 0 and $this->weatherobject["latitude"] == 0){
                        exit("Ip-adressen matchar ingen geografisk plats. Denna vädertjänst redovisar inga cyberväder");
                    }
            } else {
                exit("Du matade in en felaktig ip-adress!");
            }
        } else {
            $this->weatherobject["latitude"]= $latitude;
            $this->weatherobject["longitude"] = $longitude;
            list($this->weatherobject["country"], $this->weatherobject["city"]) = $this->OSMR->OSMCheckCoordinates($longitude, $latitude);
        }

        $this->weatherobject["weatherresult"] = $this->darkSky->weather($this->weatherobject["longitude"],
            $this->weatherobject["latitude"], $type);

        return $this->weatherobject;
    }
}
