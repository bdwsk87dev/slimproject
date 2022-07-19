<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\Services\LangService;
use App\Helpers\CommonHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class LangController
{
    /**
     * Endpoint по получению списка языковых текстовок для страницы
     */
    public function getAll(Request $request, Response $response, array $args): Response
    {
        $result = LangService::getAllData($args);

        return CommonHelper::writeResponse($response, $result);
    }

    /**
     * Endpoint по получению списка языковых текстовок для конкретного блока страницы
     */
    public function getOne(Request $request, Response $response, array $args): Response
    {
        $result = LangService::getOneData($args);

        return CommonHelper::writeResponse($response, $result);
    }
}
