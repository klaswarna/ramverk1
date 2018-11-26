<?php

namespace KW\KWcontroller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpRestfulController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * This is the index method action, it handles:
     * POST METHOD mountpoint
     * POST METHOD mountpoint/
     * POST METHOD mountpoint/index
     * Return status of given ip-number
     *
     * @return array
     */
    public function indexActionPost() : array
    {
        //$ipn = $this->di->request->getPost("ipnummer");
        $ipn = $this->di->get("request")->getPost("ipnummer");
        if (!filter_var($ipn, FILTER_VALIDATE_IP)) {
            $json = [
                    "ip-number" => $ipn,
                    "message" => "Not a valid ip-number"
                ];
        } else {
            $type = (filter_var($ipn, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? "ipv4" : "ipv6" );
            $domainname = gethostbyaddr($ipn);

            $domainname = ($domainname == $ipn ? "none" : $domainname);

            $json = [
                    "ip-number" => $ipn,
                    "message" => "Valid ip-number",
                    "type" => $type,
                    "domain name" => $domainname
                ];
        }
        return [$json];
    }
}
