<?php
/**
 * Load the WeatherController.
 */
return [
    "routes" => [
        [
            "info" => "kolla upp väder från Dark Sky",
            "mount" => "weather", //(url)
            "handler" => "\KW\KWcontroller\WeatherController", //vilken klass som den tas om hand om
        ],
    ]
];
