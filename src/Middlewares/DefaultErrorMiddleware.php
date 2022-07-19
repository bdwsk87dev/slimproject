<?php

declare(strict_types=1);

use App\Helpers\ResultHelper;
use Monolog\Utils;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Slim\App;

return function (App $app, LoggerInterface $logger)
{
    // Define Custom Error Handler
    $customErrorHandler = function (
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails,
        ?LoggerInterface $loggerDefault = null
    ) use ($app, $logger) {
        $eType = class_basename($exception);
        $eFullType = Utils::getClass($exception);
        $eCode = $exception->getCode();
        $eMessage = rtrim($exception->getMessage(), "\.");
        $eFile = $exception->getFile();
        $eLine = $exception->getLine();
        $eTrace = $exception->getTraceAsString();

        $result = [
            'code' => $eCode,
            'message' => $eMessage,
            'type' => $eType,
            'file' => $eFile,
            'line' => $eLine,
        ];
        $resultJson = ResultHelper::getResultException($result);

        $logger->error(sprintf(
            "%d %s Type: %s Code: %s Message: %s. File: %s Line: %s Trace: %s",
            $eCode, ucwords($eMessage), $eFullType, $eCode, $eMessage, $eFile, $eLine, $eTrace
        ));

        $response = $app->getResponseFactory()->createResponse();
        $response->getBody()->write($resultJson);

        return $response;
    };

    $errorMiddleware = $app->addErrorMiddleware(true, true, true, $logger);

    if (env("APP_ENV", "dev") == "prod") {
        $errorMiddleware->setDefaultErrorHandler($customErrorHandler);
    }
};
