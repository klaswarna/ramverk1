<?php

namespace KW\KWcontroller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * This is the index method action, it handles:
     * GET METHOD mountpoint
     * GET METHOD mountpoint/
     * GET METHOD mountpoint/index
     *
     * @return object
     */
    public function indexActionGet()
    {
        $page = $this->di->get("page");
        $page->add("anax/v2/weather/formular");
        return $page->render([
            "title"=>"Väder"
        ]);
    }

    /*
    * @return object
    */
    public function restinfoActionGet()
    {
        $page = $this->di->get("page");
        $page->add("anax/v2/weather/restinfo");

        return $page->render([
            "title"=>"Väder"
        ]);
    }


    /**
    * Return weather from darkSky
    *
    * @return object
    */
    public function resultActionGet()
    {
        $longitude = null;
        $latitude = null;
        $ipn = "";
        $longitude = $this->di->get("request")->getGet("longitude");
        $latitude = $this->di->get("request")->getGet("latitude");
        $type = $this->di->get("request")->getGet("type");
        $ipn = $this->di->get("request")->getGet("ipnummer");

        $darkSkyUmbrella = new \KW\Models\DarkSkyUmbrella;

        $res = $darkSkyUmbrella->input($longitude, $latitude, $type, $ipn);

        $page = $this->di->get("page");
        $page->add("anax/v2/weather/result", [
            "res" => $res,
            "longitude" => $longitude,
            "latitude" => $latitude,
            ]);

        return $page->render([
            "title" => "Väderresultat"
            ]);
    }


    /**
    * Return weather from restfully
    *
    * @return object
    */
    public function restActionGet() : array
    {
        $longitude = null;
        $latitude = null;
        $ipn = "";
        $longitude = $this->di->get("request")->getGet("lon");
        $latitude = $this->di->get("request")->getGet("lat");
        $type = $this->di->get("request")->getGet("type");
        $ipn = $this->di->get("request")->getGet("ipn");

        $darkSkyUmbrella = new \KW\Models\DarkSkyUmbrella;
        //$jsonWeather = new \KW\Models\JsonWeather;
        $jsonWeather = $this->di->get("jsonWeather");

        $res1 = $darkSkyUmbrella->input($longitude, $latitude, $type, $ipn);
        $res = $jsonWeather->jsonify($res1);

        return $res;
    }
}
