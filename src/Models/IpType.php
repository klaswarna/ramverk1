<?php

namespace KW\Models;

class IpType
{
    /**
     * Check ip-type
     *
     * @return string
     */
    public function ipType(string $ipnumber)
    {
        $type = (filter_var($ipnumber, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? "ipv4" : "ipv6" );
        // $domainname = gethostbyaddr($ipnumber);
        // $domainname = ($domainname == $ipnumber ? "none" : $domainname);
        return $type;
    }
}
