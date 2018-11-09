<?php
/**
 * Load the sample json controller.
 */
return [
    "routes" => [
        [
            "info" => "Sample Json Controller.",
            "mount" => "json", //(url)
            "handler" => "\Anax\Controller\SampleJsonController", //vilken klass som den tas om hand om
        ],
    ]
];
