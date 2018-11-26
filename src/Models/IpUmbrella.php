<?php

namespace KW\Models;

class IpUmbrella
{

    /**
    * @var array $ipobjekt array med info om ett ipnummer
    */

    public $ipobject = array(
        "number" => "",
        "valid" => false,
        "type" => "invalid",
        "domainname" => "none",
        "latitude" => 0,
        "longitude" => 0,
        "country" => "none",
        "city" => "none",
    );

    protected $ipValidate;
    protected $ipType;
    protected $ipDomainname;
    protected $ipCheckCoordinates;

    public function __construct()
    {
        $this->ipValidate = new IpValidate;
        $this->ipType = new IpType;
        $this->ipDomainname = new IpDomainname;
        $this->ipCheckCoordinates = new IpCheckCoordinates;
    }



    /*private $ipValidate = new IpValidate;
    private $ipType = new IpType;
    private $ipDomainname = new IpDomainname;
    private $ipCheckCoordinates = new IpCheckCoordinates;*/

    /**
     * Check ip-type sdf saf sdf safd fsda
     *
     * @return array
     */
    public function input(string $ipnumber)
    {
        /*$this->ipobject["number"] = $ipnumber;
        $this->ipobject["valid"] = IpValidate::validate($ipnumber);


        if ($this->ipobject["valid"]) {
            $this->ipobject["type"] = IpType::ipType($ipnumber);
            $this->ipobject["domainname"] = IpDomainname::ipDomainname($ipnumber);
            list($this->ipobject["latitude"], $this->ipobject["longitude"], $this->ipobject["country"], $this->ipobject["city"])
                = IpCheckCoordinates::ipCheckCoordinates($ipnumber);
        }*/

        $this->ipobject["number"] = $ipnumber;
        $this->ipobject["valid"] = $this->ipValidate->validate($ipnumber);


        if ($this->ipobject["valid"]) {
            $this->ipobject["type"] = $this->ipType->ipType($ipnumber);
            $this->ipobject["domainname"] = $this->ipDomainname->ipDomainname($ipnumber);
            list($this->ipobject["latitude"], $this->ipobject["longitude"], $this->ipobject["country"], $this->ipobject["city"])
                = $this->ipCheckCoordinates->ipCheckCoordinates($ipnumber);
        }

        return $this->ipobject;
    }
}
