<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\Services\AuthService;
use App\Controllers\Services\LangService;
use App\Helpers\CommonHelper;
use App\Helpers\ResultHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function register(Request $request, Response $response): Response
    {
        $result = AuthService::register($request, $response);
        return CommonHelper::writeResponse($response, $result);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function login(Request $request, Response $response): Response
    {
        $result = AuthService::login($request, $response);
        return CommonHelper::writeResponse($response, $result);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function logout(Request $request, Response $response){
        setcookie('token', '', -1, '/');
        $responseMessage = "user is login out";
        return CommonHelper::writeResponse($response, $responseMessage);
    }

}