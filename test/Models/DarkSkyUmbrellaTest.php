<?php

//namespace KW\KWcontroller;
namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class DarkSkyUmbrellaTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $models;



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

        // Setup the models
        $this->models = new \KW\Models\DarkSkyUmbrella($di);
    }

    /**
     * Test inputing invalid coordinates
     */
    public function testWrongCoordinates()
    {
        $res = $this->models->input(181, 92, "", "");

        $exp = "felaktiga koordinater";
        $this->assertContains($exp, $res);
    }

    /**
    * the correct ip-number with existing geographical place
    */
    public function testCorrectIp()
    {
        $res = $this->models->input(0, 0, "number", "1.2.3.4");

        $exp = "felaktiga koordinater";
        $this->assertContains($exp, $res);
    }

    /**
    * the correct ip-number with non existing geographical place
    */
    public function testCorrectIpWithoutGeo()
    {
        $res = $this->models->input(0, 0, "number", "2001:0db8:0000:0000:0000:0000:1428:07ab");

        $exp = "ingen geografisk plats";
        $this->assertContains($exp, $res);
    }

    /**
    * incorrect
    */
    public function testInCorrectIp()
    {
        $res = $this->models->input(0, 0, "number", "123.123.cykel.123");

        $exp = "felaktig ip-adress";
        $this->assertContains($exp, $res);
    }

    /**
    * test my coorinates
    */
    public function testCorrectCoordinates()
    {
        $res = $this->models->input(13.1927, 55.7028, "", "");

        $exp = "Lund";
        $this->assertContains($exp, $res);
    }

    /**
    * test my coorinates future
    */
    public function testCorrectCoordinatesFuture()
    {
        $res = $this->models->input(13.1927, 55.7028, "future", "");

        $exp = "Lund";
        $this->assertContains($exp, $res);
    }
}
