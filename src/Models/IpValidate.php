<?php

namespace KW\Models;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;


/**
 * Verfies wether an ip address is valid or not
 *
 */

class IpValidate implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * Verify an ip-adress is valid
     *
     * @param string $ipnumber to verify
     *
     * @return boolean
     */
    public function validate(string $ipnumber)
    {
        if (!filter_var($ipnumber, FILTER_VALIDATE_IP)) {
            return false;
        }
        return true;
    }
}
