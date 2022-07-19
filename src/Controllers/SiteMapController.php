<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\Services\SiteMapService;
use App\Helpers\CommonHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SiteMapController
{
    /**
     * Endpoint по получению списка всех урлов с учетом языка
     */
    public function index(Request $request, Response $response, array $args): Response
    {
        $result = SiteMapService::getIndexData($args);

        return CommonHelper::writeResponse($response, $result);
    }
}
