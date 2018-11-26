<?php

//namespace KW\KWcontroller;
namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpWebControllerTest extends TestCase
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
        $this->controller = new \KW\KWcontroller\IpWebController();
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
     * Test the route "ipnummer" with invalid number
     */
    public function testIpnummerActionGet()
    {
        $res = $this->controller->ipnummerActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertInternalType("object", $res);

        $body = $res->getBody();
        $exp = "| ramverk1</title>";
        $this->assertContains($exp, $body);
    }


    /**
     * Test the route "ipnummer" with valid number
     */
    public function testIpnummerActionGet2()
    {
        $this->di->get("request")->setGet("ipnummer", "123.123.123.123");
        $res = $this->controller->ipnummerActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertInternalType("object", $res);

        $body = $res->getBody();
        $exp = "| ramverk1</title>";
        $this->assertContains($exp, $body);
    }
}
