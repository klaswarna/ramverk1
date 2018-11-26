<?php
/**
 * Load the IpWebController.
 */
return [
    "routes" => [
        [
            "info" => "verify ip number return string",
            "mount" => "ipweb", //(url)
            "handler" => "\KW\KWcontroller\IpWebController", //vilken klass som den tas om hand om
        ],
    ]
];
