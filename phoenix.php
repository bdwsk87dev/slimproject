<?php

/*
    php vendor/bin/phoenix migrate
    php vendor/bin/phoenix create "Migrations\{custom_name}" basic
    change default_environment!
*/

echo __DIR__ . '/src/Migrations';

return [
    'migration_dirs' => [
        'basic' => __DIR__ . '/src/Migrations'
    ],
    'environments' => [
        'alex-docker'=>[
            'adapter' => 'mysql',
            'host' => 'main-store_mysql_1',
            'port' => 3306,// optional
            'username' => 'alex',
            'password' => '15616',
            'db_name' => 'mainstore',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
        ],
        'local' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'port' => 3306,// optional
            'username' => 'alex',
            'password' => '',
            'db_name' => 'mainstore',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
        ],
        'production' => [
            'adapter' => '',
            'host' => '',
            'port' => 3306, // optional
            'username' => '',
            'password' => '',
            'db_name' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
        ],
    ],
    'default_environment' => 'alex-docker',
    'log_table_name' => 'phoenix_log',
];