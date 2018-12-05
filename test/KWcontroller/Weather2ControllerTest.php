<?php

//namespace KW\KWcontroller;
namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class Weather2ControllerTest extends TestCase
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
     * Test the route "restinfo".
     */
    public function testRestActionGet()
    {
        $res = $this->controller->restActionGet();
        //$this->assertInstanceOf("\Anax\Response\Response", $res);

        $this->assertInternalType("array", $res);
    }
}
