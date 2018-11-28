<?php
/**
 * Configuration file for DI container. Tillagd av KW kmom03 men inte använd
 */
return [

    // Services to add to the container.
    "services" => [
        "ipValidate" => [
            "shared" => true,
            "active" => true,
            "callback" => function () {
                $obj = new \KW\Models\IpValidate();
                return $obj;
            }
        ],
    ],
];
