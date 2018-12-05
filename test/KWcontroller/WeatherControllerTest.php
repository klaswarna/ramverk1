<?php

//namespace KW\KWcontroller;
namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherControllerTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;



    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new \KW\KWcontroller\WeatherController();
        $this->controller->setDI($this->di);
        //$this->controller->initialize();
    }


    /**
     * JsonWeather
     */
    public function testJsonWeather()
    {
        //$jsonWeather = new \KW\Models\JsonWeather();
        $jsonWeather = $this->di->get("jsonWeather");

        $data = ["hej" => "hopp"];
        $daily = ["data" => $data];
        $sune = ["daily" => $daily];
        $sune = json_decode(json_encode($sune));
        $input = [
            "latitude"=>"23",
            "longitude"=>"23",
            "type"=>"future",
            "country"=>"Sverige",
            "town"=>"Stockholm",
            "weatherresult" => $sune,
        ];


        $res = $jsonWeather->jsonify($input);

        $this->assertInternalType("array", $res);
    }
}
