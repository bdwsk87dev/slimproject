<?php

declare(strict_types=1);

use DevCoder\DotEnv;
use DI\ContainerBuilder;
use RKA\Middleware\IpAddress;
use Slim\Factory\AppFactory;
use Middlewares\TrailingSlash;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once vendor_path("autoload.php");
(new DotEnv(env_path(".env")))->load();


$builder = new ContainerBuilder();
$container = $builder->build();
AppFactory::setContainer($container);
$app = AppFactory::create();
$app->add(new TrailingSlash(false));
$app->add(new IpAddress());

$_SERVER['app'] = &$app;

if (!function_exists("app")) {
    function app() {
        return $_SERVER['app'];
    }
}


$logger = new Logger("[GMB-APP]");
$streamHandler = new StreamHandler(log_path(date("Y-m-d") . ".log"), Level::Warning);
$logger->pushHandler($streamHandler);


(require_once src_path("Middlewares/DefaultErrorMiddleware.php"))($app, $logger);
//(require_once src_path("Middlewares/AuthMiddleware.php"))($app);
(require_once routes_path("routes.php"))($app);
(require_once src_path("database.php"))();

return $app;
