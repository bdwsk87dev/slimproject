<?php

declare(strict_types=1);

namespace App\Helpers;

use Psr\Http\Message\ResponseInterface as Response;

class CommonHelper
{
    public static function writeResponse(Response $response, string $json): Response
    {
        $response->getBody()->write($json);

        return $response
            ->withHeader("Content-Type", "application/json")
            ->withHeader("Access-Control-Allow-Origin", "*");
    }
}
