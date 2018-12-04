<?php

namespace KW\Models;

class IpDomainname
{
    /**
     * Check ip-dommainname
     *
     * @return string
     */
    public function ipDomainname(string $ipnumber)
    {
        $domainname = gethostbyaddr($ipnumber);
        $domainname = ($domainname == $ipnumber ? "none" : $domainname);
        return $domainname;
    }
}
