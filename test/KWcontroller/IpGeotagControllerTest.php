<?php

//namespace KW\KWcontroller;
namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpGeotagControllerTest extends TestCase
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
        $this->controller = new \KW\KWcontroller\IpGeotagController();
        $this->controller->setDI($this->di);
    }


    /**
     * Test the route "index".
     */
    public function testIndexActionPost()
    {
        $this->di->get("request")->setGlobals(
            [
                'post' => [
                    'ipnummer' => "132.248.10.7"
                ]
            ]
        );
        $res = $this->controller->indexActionPost();
        $this->assertInternalType("array", $res);

        $json = $res[0];
        $exp = "ipv4";
        $this->assertContains($exp, $json["type"]);
    }

    /**
     * Test the route "index" with invalid ip-number.
     */
    public function testIndexActionPost2()
    {
        $this->di->get("request")->setGlobals(
            [
                'post' => [
                    'ipnummer' => "uåt.132.248.10.7"
                ]
            ]
        );
        $res = $this->controller->indexActionPost();
        $this->assertInternalType("array", $res);

        $json = $res[0];
        $exp = "none";
        $this->assertContains($exp, $json["domainname"]);
    }
}
