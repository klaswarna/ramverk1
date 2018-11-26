<?php
/**
 * Load the IpRestfulController.
 */
return [
    "routes" => [
        [
            "info" => "verify ip number return json",
            "mount" => "iprest", //(url)
            "handler" => "\KW\KWcontroller\IpRestfulController", //vilken klass som den tas om hand om
        ],
    ]
];
