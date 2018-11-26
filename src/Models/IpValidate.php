<?php

namespace KW\Models;

class IpValidate
{
    /**
     * Verify an ip-adress is valid
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
