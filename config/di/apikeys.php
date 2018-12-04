<?php
/**
 * Config file for apikeys.
 */
return [
    "services" => [
        "apikeys" => [
            "shared" => true,
            "callback" => function () {
                // Load the configuration files
                $cfg = $this->get("configuration");
                $config = $cfg->load("apikeys.php");
                return $config;
            }
        ]
    ]
];
