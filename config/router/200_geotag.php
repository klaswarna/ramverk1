<?php
/**
 * Load the IpRestfulController.
 */
return [
    "routes" => [
        [
            "info" => "localize ip number",
            "mount" => "geotag", //(url)
            "handler" => "\KW\KWcontroller\IpGeotagController", //vilken klass som den tas om hand om
        ],
    ]
];
