<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as DB;

return function () {
    $default = config("database.default");
    $connections = config("database.connections");

    $capsule = new DB;
    $capsule->addConnection(data_get($connections, $default));
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
};