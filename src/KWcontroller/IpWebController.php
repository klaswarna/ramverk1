<?php

namespace KW\KWcontroller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpWebController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * This is the index method action, it handles:
     * GET METHOD mountpoint
     * GET METHOD mountpoint/
     * GET METHOD mountpoint/index
     *
     * @return object
     */
    public function indexActionGet()
    {
        $page = $this->di->get("page");
        $page->add("anax/v2/ipweb/default");

        return $page->render([
            "title"=>"Mata in ipnummer"
        ]);
    }

    /**
    * Return status of given ip-number
    *
    * @return object
    */
    public function ipnummerActionGet()
    {
        //$ipn = $this->di->request->getGet("ipnummer");
        $ipn = $this->di->get("request")->getGet("ipnummer");
        if (!filter_var($ipn, FILTER_VALIDATE_IP)) {
            $res = [
                    "ip-number" => $ipn,
                    "message" => "Not a valid ip-number"
                ];
        } else {
            $type = (filter_var($ipn, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? "ipv4" : "ipv6" );
            $domainname = gethostbyaddr($ipn);

            $domainname = ($domainname == $ipn ? "none" : $domainname);

            $res = [
                    "ipnumber" => $ipn,
                    "message" => "Valid ip-number",
                    "type" => $type,
                    "domain name" => $domainname
                ];
        }
        $page = $this->di->get("page");
        $page->add("anax/v2/ipweb/result", [
            "res" => $res
            ]);

        return $page->render([
            "title" => "Resultat"
            ]);
    }
}
