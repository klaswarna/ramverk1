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
        "key"=> "8fc8b212a2c3531bdd01693e25e1442f",
        "time"=>"",
        "type" => "future",
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
    protected $weatherTime;
    protected $darkSky;

    public function __construct()
    {
        $this->ipValidate = new IpValidate;
        $this->ipType = new IpType;
        $this->ipCheckCoordinates = new IpCheckCoordinates;

        $this->OSMR = new OpenStreetMapReverse;
        $this->weatherTime = new WeatherTime;
        $this->darkSky = new DarkSky;
    }


    /**
     * Get url-type according to type and position to send to Dark Sky
     *
     * @return array
     */
    public function input($longitude, $latitude, $type, $ipn)
    {

        $this->weatherobject["time"] = $this->weatherTime->check($type);

        if ($ipn!="") {
            $this->weatherobject["valid"] = $this->ipValidate->validate($ipn);
            if ($this->weatherobject["valid"]) {
                list($this->weatherobject["latitude"], $this->weatherobject["longitude"], $this->weatherobject["country"], $this->weatherobject["city"])
                    = $this->ipCheckCoordinates->ipCheckCoordinates($ipn);
            }
        } else {
            $this->weatherobject["latitude"]= $latitude;
            $this->weatherobject["longitude"] = $longitude;
            list($this->weatherobject["country"], $this->weatherobject["city"]) = $this->OSMR->OSMCheckCoordinates($longitude, $latitude);
        }

        $this->weatherobject["weatherresult"] = $this->darkSky->weather($this->weatherobject["longitude"], $this->weatherobject["latitude"]);

        return $this->weatherobject;
    }
}
