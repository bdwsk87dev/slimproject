<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\Validators\ReviewValidator;
use App\Controllers\Services\ReviewService;
use App\Helpers\CommonHelper;
use App\Helpers\ParamsHelper;
use App\Helpers\ResultHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ReviewController
{
    public function getAll(Request $request, Response $response, array $args): Response
    {
        $params = ParamsHelper::getParamsGet($request, ReviewValidator::getAllValidator());

        if (isset($params['invalid'])) {
            $resultJson = ResultHelper::getResultInvalid($params['params']);

            return CommonHelper::writeResponse($response, $resultJson);
        }

        $result = ReviewService::getAllData([...$args, ...$params]);

        return CommonHelper::writeResponse($response, $result);

    }

    public function getOne(Request $request, Response $response, array $args): Response
    {
        $result = ReviewService::getOneData($args);

        return CommonHelper::writeResponse($response, $result);
    }

    //
    public function getAllByLocationId(Request $request, Response $response, array $args): Response
    {
        $params = ParamsHelper::getParamsGet($request, ReviewValidator::getReviewsByLocationIdValidator());

        if (isset($params['invalid'])) {
            $resultJson = ResultHelper::getResultInvalid($params['params']);

            return CommonHelper::writeResponse($response, $resultJson);
        }

        $result = ReviewService::getAllByLocationId([...$args, ...$params]);

        return CommonHelper::writeResponse($response, $result);
    }

    //создавать/удалять можно только ответы - это апдейт полей r_comment_reply, r_time_reply
    public function update(Request $request, Response $response, array $args): Response
    {
        $params = ParamsHelper::getParamsBody($request, ReviewValidator::getReviewPostValidator());
        if (isset($params['invalid'])) {
            $resultJson = ResultHelper::getResultInvalid($params['params']);

            return CommonHelper::writeResponse($response, $resultJson);
        }

        $result = ReviewService::updateReview([...$args, ...$params]);

        return CommonHelper::writeResponse($response, $result);
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $result = ReviewService::updateReview($args);

        return CommonHelper::writeResponse($response, $result);
    }
    /**
     * Endpoint по получению данных для фильров
     */
    public function getFilters(Request $request, Response $response, array $args): Response
    {
        # -- checking params for validity
        $params = ParamsHelper::getParamsGet($request, ReviewValidator::getFiltersValidator());

        if (isset($params['invalid'])) {
            $result = ResultHelper::getResultInvalid($params['params']);

            return CommonHelper::writeResponse($response, $result);
        }
        # // checking params for validity

        $result = ReviewService::getFiltersData([...$args, ...$params]);

        return CommonHelper::writeResponse($response, $result);
    }

}
