<?php

namespace KW\Models;

class WeatherTime
{
    /**
     * Verify an ip-adress is valid
     *
     * @return boolean
     */
    public function check(string $type)
    {
        if ($type!="past") {
            return "";
        }

        $datum = new Date;

        $answer = date("U");

        echo("tidssekunder: " . $answer);

        return $answer;
    }
}
