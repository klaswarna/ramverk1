<?php
/**
 * Configuration file for DI container. Tillagd av KW kmom03
 */
return [

    // Services to add to the container.
    "services" => [
        "jsonWeather" => [
            "shared" => true,
            "active" => true,
            "callback" => function () {
                $obj = new \KW\Models\JsonWeather();
                return $obj;
            }
        ],
    ],
];
