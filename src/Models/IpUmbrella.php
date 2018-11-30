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

    public function __construct($di)
    {
        $this->di = $di;
        $this->ipValidate = new IpValidate($this->di);
        $this->ipType = new IpType($this->di);
        $this->ipDomainname = new IpDomainname($this->di);
        $this->ipCheckCoordinates = new IpCheckCoordinates($this->di);
    }

    /**
     * Check ip-type sdf saf sdf safd fsda
     *
     * @return array
     */
    public function input(string $ipnumber)
    {

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
