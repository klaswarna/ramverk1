<?php

namespace KW\KWcontroller;

//namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpRestfulControllerTest extends TestCase
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
        $this->controller = new IpRestfulController();
        $this->controller->setDI($this->di);
        //$this->controller->initialize();
    }


    /**
     * Test the route "index".
     */
    public function testIndexActionPost()
    {
        //$this->di->get("request")->setPost("ipnummer", "123.123.123.123");
        $res = $this->controller->indexActionPost();
        $this->assertInternalType("array", $res);

        $json = $res[0];
        $exp = "Not a valid ip-number";
        $this->assertContains($exp, $json["message"]);
    }


    public function testIndexActionPost2()
    {
        //with valid number
        $this->di->get("request")->setPost("ipnummer", "123.123.123.123");
        //$this->di->get("request")->setGet("ipnummer", "123.123.123.123");
        $res = $this->controller->indexActionPost();
        $this->assertInternalType("array", $res);

        $json = $res[0];
        $exp = "Valid ip-number";
        $this->assertContains($exp, $json["message"]);
    }
}
