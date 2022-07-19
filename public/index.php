<?php

declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

/** @var Slim\App $app */
$app = require_once public_path("app.php");

$app->run();
