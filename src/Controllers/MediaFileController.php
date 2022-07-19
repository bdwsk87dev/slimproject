<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\Services\MediaFileService;
use App\Controllers\Validators\MediaFileValidator;
use App\Helpers\CommonHelper;
use App\Helpers\ParamsHelper;
use App\Helpers\ResultHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MediaFileController
{
    /**
     * Endpoint по получению списка медиа файлов
     */
    public function getAll(Request $request, Response $response, array $args): Response
    {
        # -- checking params for validity
        $params = ParamsHelper::getParamsGet($request, MediaFileValidator::getAllValidator());

        if (isset($params['invalid'])) {
            $result = ResultHelper::getResultInvalid($params['params']);

            return CommonHelper::writeResponse($response, $result);
        }
        # // checking params for validity

        $result = MediaFileService::getAllData([...$args, ...$params]);

        return CommonHelper::writeResponse($response, $result);
    }

    /**
     * Endpoint по получению одного медиа файла
     */
    public function getOne(Request $request, Response $response, array $args): Response
    {
        # -- checking media file for existence
        $mediaFile = MediaFileService::getMediaFileData($args);

        if (is_null($mediaFile)) {
            $result = ResultHelper::getResultFail("Media file wasn't found!");

            return CommonHelper::writeResponse($response, $result);
        }
        # // checking media file for existence

        $result = MediaFileService::getOneData($mediaFile, $args);

        return CommonHelper::writeResponse($response, $result);
    }

    /**
     * Endpoint по получению списка медиа файлов для конкретной локации
     */
    public function getAllByLocationId(Request $request, Response $response, array $args): Response
    {
        # -- checking params for validity
        $params = ParamsHelper::getParamsGet($request, MediaFileValidator::getAllByLocationIdValidator());

        if (isset($params['invalid'])) {
            $result = ResultHelper::getResultInvalid($params['params']);

            return CommonHelper::writeResponse($response, $result);
        }
        # // checking params for validity

        $result = MediaFileService::getAllByLocationIdData([...$args, ...$params]);

        return CommonHelper::writeResponse($response, $result);
    }

    /**
     * Endpoint по созданию медиа файла
     */
    public function create(Request $request, Response $response, array $args): Response
    {
        # -- checking params for validity
        $params = ParamsHelper::getParamsBody($request, MediaFileValidator::createValidator());

        if (isset($params['invalid'])) {
            $resultJson = ResultHelper::getResultInvalid($params['params']);

            return CommonHelper::writeResponse($response, $resultJson);
        }
        # // checking params for validity

        $result = MediaFileService::getCreateData($params);

        return CommonHelper::writeResponse($response, $result);
    }

    /**
     * Endpoint по обновлению медиа файла
     */
    public function update(Request $request, Response $response, array $args): Response
    {
        # -- checking media file for existence
        $mediaFile = MediaFileService::getMediaFileData($args);

        if (is_null($mediaFile)) {
            $result = ResultHelper::getResultFail("Media file wasn't found!");

            return CommonHelper::writeResponse($response, $result);
        }
        # // checking media file for existence

        # -- checking params for validity
        $params = ParamsHelper::getParamsBody($request, MediaFileValidator::updateValidator());

        if (isset($params['invalid'])) {
            $resultJson = ResultHelper::getResultInvalid($params['params']);

            return CommonHelper::writeResponse($response, $resultJson);
        }
        # // checking params for validity

        $result = MediaFileService::getUpdateData($mediaFile, [...$args, ...$params]);

        return CommonHelper::writeResponse($response, $result);
    }

    /**
     * Endpoint по удалению медиа файла
     */
    public function delete(Request $request, Response $response, array $args): Response
    {
        # -- checking media file for existence
        $mediaFile = MediaFileService::getMediaFileData($args);

        if (is_null($mediaFile)) {
            $result = ResultHelper::getResultFail("Media file wasn't found!");

            return CommonHelper::writeResponse($response, $result);
        }
        # // checking media file for existence

        $result = MediaFileService::getDeleteData($mediaFile);

        return CommonHelper::writeResponse($response, $result);
    }
}
