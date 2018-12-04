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
     * Test the route "index".
     */
    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);

        $body = $res->getBody();
        $exp = "| ramverk1</title>";
        $this->assertContains($exp, $body);
    }



    /**
     * Test the result with valid number past time
     */
    public function testResultActionGet()
    {
        $this->di->get("request")->setGet("ipnummer", "139.59.153.123");
        $this->di->get("request")->setGet("type", "future");
        $res = $this->controller->resultActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertInternalType("object", $res);

        $body = $res->getBody();
        $exp = "| ramverk1</title>";
        $this->assertContains($exp, $body);
    }

    /**
     * Test the result with valid number past time
     */
    public function testResultActionGet2()
    {
        $this->di->get("request")->setGet("ipnummer", "139.59.153.123");
        $this->di->get("request")->setGet("type", "past");
        $res = $this->controller->resultActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertInternalType("object", $res);

        $body = $res->getBody();
        $exp = "| ramverk1</title>";
        $this->assertContains($exp, $body);
    }

    /**
     * Test the result with valid koordinates
     */
    public function testResultActionGet3()
    {
        $this->di->get("request")->setGet("latitude", "57.6302");
        $this->di->get("request")->setGet("longitude", "18.2988");
        $this->di->get("request")->setGet("type", "future");
        $res = $this->controller->resultActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertInternalType("object", $res);

        $body = $res->getBody();
        $exp = "| ramverk1</title>";
        $this->assertContains($exp, $body);
    }

    /**
     * Test the result with invalid koordinates
     */
    public function testResultActionGet4()
    {
        $this->di->get("request")->setGet("latitude", "576302");
        $this->di->get("request")->setGet("longitude", "182988");
        $this->di->get("request")->setGet("type", "future");
        $res = $this->controller->resultActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertInternalType("object", $res);

        $body = $res->getBody();
        $exp = "| ramverk1</title>";
        $this->assertContains($exp, $body);
    }

    /**
     * Test the result with insuffient
     */
    public function testResultActionGet5()
    {
        $this->di->get("request")->setGet("latitude", "57.6302");

        $this->di->get("request")->setGet("type", "future");
        $res = $this->controller->resultActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertInternalType("object", $res);

        $body = $res->getBody();
        $exp = "| ramverk1</title>";
        $this->assertContains($exp, $body);
    }

    /**
     * Test the result with invalid ip
     */
    public function testResultActionGet6()
    {
        $this->di->get("request")->setGet("ipnummer", "139.59.cykel.153.123");
        $this->di->get("request")->setGet("type", "future");
        $res = $this->controller->resultActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertInternalType("object", $res);

        $body = $res->getBody();
        $exp = "| ramverk1</title>";
        $this->assertContains($exp, $body);
    }

    /**
     * Test the result with no geographical corresponding place
     */
    public function testResultActionGet7()
    {
        $this->di->get("request")->setGet("ipnummer", "2001:0db8:0000:0000:0000:0000:1428:07ab");
        $this->di->get("request")->setGet("type", "future");
        $res = $this->controller->resultActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertInternalType("object", $res);

        $body = $res->getBody();
        $exp = "| ramverk1</title>";
        $this->assertContains($exp, $body);
    }

    /**
     * Test the rest with valid number past time
     */
    public function testRestActionGet()
    {
        $this->di->get("request")->setGet("ipnumber", "139.59.153.123");
        $this->di->get("request")->setGet("type", "future");
        $res = $this->controller->resultActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertInternalType("object", $res);

        $body = $res->getBody();
        $exp = "| ramverk1</title>";
        $this->assertContains($exp, $body);
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
