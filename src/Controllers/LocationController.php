<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\Services\LocationService;
use App\Controllers\Validators\LocationValidator;
use App\Helpers\CommonHelper;
use App\Helpers\ParamsHelper;
use App\Helpers\ResultHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class LocationController
{
    /**
     * Endpoint по получению всех фильтров
     */
    public function getFilters(Request $request, Response $response, array $args): Response
    {
        # -- checking params for validity
        $params = ParamsHelper::getParamsGet($request, LocationValidator::getFiltersValidator());

        if (isset($params['invalid'])) {
            $result = ResultHelper::getResultInvalid($params['params']);

            return CommonHelper::writeResponse($response, $result);
        }
        # // checking params for validity

        $result = LocationService::getFiltersData([...$args, ...$params]);

        return CommonHelper::writeResponse($response, $result);
    }

    /**
     * Endpoint по получению списка локаций
     */
    public function getAll(Request $request, Response $response, array $args): Response
    {
        # -- checking params for validity
        $params = ParamsHelper::getParamsGet($request, LocationValidator::getAllValidator());

        if (isset($params['invalid'])) {
            $result = ResultHelper::getResultInvalid($params['params']);

            return CommonHelper::writeResponse($response, $result);
        }
        # // checking params for validity

        $result = LocationService::getAllData([...$args, ...$params]);

        return CommonHelper::writeResponse($response, $result);
    }

    /**
     * Endpoint по получению одной локации
     */
    public function getOne(Request $request, Response $response, array $args): Response
    {
        # -- checking location for existence
        $location = LocationService::getLocationData($args);

        if (is_null($location)) {
            $result = ResultHelper::getResultFail("Location wasn't found!");

            return CommonHelper::writeResponse($response, $result);
        }
        # // checking location for existence

        $result = LocationService::getOneData($location, $args);

        return CommonHelper::writeResponse($response, $result);
    }

    /**
     * Endpoint по получению одной локации с доп. данными для обновления
     */
    public function getOneForUpdate(Request $request, Response $response, array $args): Response
    {
        # -- checking location for existence
        $location = LocationService::getLocationData($args);

        if (is_null($location)) {
            $result = ResultHelper::getResultFail("Location wasn't found!");

            return CommonHelper::writeResponse($response, $result);
        }
        # // checking location for existence

        $result = LocationService::getOneForUpdateData($location, $args);

        return CommonHelper::writeResponse($response, $result);
    }

    /**
     * Endpoint по созданию локации
     */
    public function create(Request $request, Response $response, array $args): Response
    {
        # -- checking params for validity
        $params = ParamsHelper::getParamsBody($request, LocationValidator::createValidator());

        if (isset($params['invalid'])) {
            $resultJson = ResultHelper::getResultInvalid($params['params']);

            return CommonHelper::writeResponse($response, $resultJson);
        }
        # // checking params for validity

        $params['ip_address'] = ParamsHelper::getParamAttributes($request, "ip_address");
        $result = LocationService::getCreateData($params);

        return CommonHelper::writeResponse($response, $result);
    }

    /**
     * Endpoint по обновлению локации
     */
    public function update(Request $request, Response $response, array $args): Response
    {
        # -- checking location for existence
        $location = LocationService::getLocationData($args);

        if (is_null($location)) {
            $result = ResultHelper::getResultFail("Location wasn't found!");

            return CommonHelper::writeResponse($response, $result);
        }
        # // checking location for existence

        # -- checking params for validity
        $params = ParamsHelper::getParamsBody($request, LocationValidator::updateValidator());

        if (isset($params['invalid'])) {
            $resultJson = ResultHelper::getResultInvalid($params['params']);

            return CommonHelper::writeResponse($response, $resultJson);
        }
        # // checking params for validity

        $params['ip_address'] = ParamsHelper::getParamAttributes($request, "ip_address");
        $result = LocationService::getUpdateData($location, [...$args, ...$params]);

        return CommonHelper::writeResponse($response, $result);
    }

    /**
     * Endpoint по удалению локации
     */
    public function delete(Request $request, Response $response, array $args): Response
    {
        # -- checking location for existence
        $location = LocationService::getLocationData($args);

        if (is_null($location)) {
            $result = ResultHelper::getResultFail("Location wasn't found!");

            return CommonHelper::writeResponse($response, $result);
        }
        # // checking location for existence

        $params['ip_address'] = ParamsHelper::getParamAttributes($request, "ip_address");
        $result = LocationService::getDeleteData($location, $params);

        return CommonHelper::writeResponse($response, $result);
    }
}
