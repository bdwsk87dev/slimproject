<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\Services\MainService;
use App\Helpers\CommonHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MainController
{
    /**
     * Endpoint по получению данных для главной страницы
     */
    public function index(Request $request, Response $response, array $args): Response
    {
        $result = MainService::getIndexData($args);

        return CommonHelper::writeResponse($response, $result);
    }
}
