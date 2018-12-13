<?php

//namespace KW\KWcontroller;
namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class CreateForm extends TestCase
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
        $this->models = new \KW\Book\HTMLForm\DeleteForm($di);
    }

/*    public function testCallbackSubmit()
    {
        $res = $this->models->callbackSubmit();

        $this->assertInternalType("bool", $res);
    }
}*/
