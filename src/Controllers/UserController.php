<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\CommonHelper;
use Illuminate\Support\Collection;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


use App\Controllers\Services\UserService;

class UserController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getUser(Request $request, Response $response): Response
    {
        $user = UserService::getUser();
        return CommonHelper::writeResponse($response, $user);
    }
}