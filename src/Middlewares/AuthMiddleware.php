<?php

declare(strict_types=1);

use App\Helpers\CommonHelper;
use \App\Helpers\ResultHelper;

return function ($app) {
    $app->add(new Tuupola\Middleware\JwtAuthentication([
        "ignore" => [
            "/.*/auth/login",
            "/.*/auth/register"
        ],
        "path" => "/",
        "secret" => getenv("JWT_KEY"),
        "relaxed" => ["localhost"],
        "error" => function ($response, $arguments) {
            $lang = 'en';
            if (preg_match("/\/en\/|\/ru\/|\/uk\//", $arguments['uri'], $match)) {
                if (isset($match[0])) {
                    $lang = $match[0];
                }
            }
            $langUsers = lang("{$lang}/user");
            $message = $langUsers['auth']['unauthorized'] ?? 'Користувач не авторизований!';
            $error = ResultHelper::getResultForbidden($message);
            return CommonHelper::writeResponse($response, $error);
        },
    ]));
};