<?php

namespace KW\Models;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class JsonWeather implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * Returns weather info in json format
     *
     * @return json
     */
    public function jsonify($res)
    {
        $days = [];
        $mapUrl = "https://www.openstreetmap.org/?mlat="
        . $res["latitude"]. "&mlon="
        . $res["longitude"] ."&zoom=12#map=12/"
        . $res["latitude"] ."/"
        . $res["longitude"];

        $type = ($res["type"] == "past" ? "past mounth" : "future week");

        $backgroundinfo = array(
            "tempus"=>$type,
            "country"=>$res["country"],
            "town"=>($res["town"] ?? "---"),
            "longitude"=>$res["longitude"],
            "latitude"=>$res["latitude"],
            "mapUrl"=>$mapUrl
        );

        if (isset($res["weatherresult"]->daily->data)) {
            foreach ($res["weatherresult"]->daily->data as $key => $value) {
                array_push($days, array("day"=>($key ?? "---"),
                    "summary"=>($value->summary ?? "---"),
                    "highesttemp"=>($value->temperatureHigh ?? "---"),
                    "lowesttemp"=>($value->temperatureLow ?? "---"),
                    "windspeed"=>($value->windSpeed ?? "---"),));
            }
        } else {
            array_push($days, "data för aktuell tid saknas!");
        }

        $result = [
            "backgroundinfo"=>$backgroundinfo,
            "days"=>$days
        ];
        //$result = json_decode(json_encode($result));

        return [$result];
    }
}
