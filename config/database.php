<?php

declare(strict_types=1);

return [
    'default' => env("DB_CONNECTION", "mysql"),

    'connections' => [
        'mysql' => [
            'driver' => env("DB_DRIVER", "mysql"),
            'host' => env("DB_HOST", "127.0.0.1"),
            'port' => env("DB_PORT", "3306"),
            'database' => env("DB_DATABASE", "gmb"),
            'username' => env("DB_USERNAME", "gmb"),
            'password' => env("DB_PASSWORD"),
            'charset' => "utf8",
            'collation' => "utf8_unicode_ci",
            'prefix' => "",
            'strict' => true,
        ],
    ],
];