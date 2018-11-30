<?php

namespace KW\KWcontroller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpGeotagController implements ContainerInjectableInterface
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
        //$server = $this->di->getServer("REMOTE_ADDR");
        $server = new \Anax\Request\Request;
        $thisip = $server->getServer("REMOTE_ADDR");
        //$server = $this->di->server;
        $page = $this->di->get("page");
        $page->add("anax/v2/geotagip/formular", [
            "thisip" => $thisip
            ]);
        return $page->render([
            "title"=>"Mata in ipnummer"
        ]);
    }

    /**
    * Return status of given ip-number
    *
    * @return object
    */
    public function resultActionGet()
    {
        $ipn = $this->di->get("request")->getGet("ipnummer");
        $res =[];

        $paraply = new \KW\Models\IpUmbrella($this->di);
        $res = $paraply->input($ipn);

        $page = $this->di->get("page");
        $page->add("anax/v2/geotagip/result", [
            "res" => $res
            ]);

        return $page->render([
            "title" => "Resultat"
            ]);
    }

    public function indexActionPost() : array
    {
        $ipn = $this->di->get("request")->getPost("ipnummer");
        $res =[];
        $paraply = new \KW\Models\IpUmbrella($this->di);
        $res = $paraply->input($ipn);

        if ($res["latitude"]) {
            $res["url-link"] = "https://www.openstreetmap.org/?mlat="
            . $res["latitude"]. "&mlon="
            . $res["longitude"] ."&zoom=12#map=12/"
            . $res["latitude"] ."/"
            . $res["longitude"];
        } else {
            $res["url-link"] = null;
        }
        return [$res];
    }
}
