<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Collection;

class ResultHelper
{
    public static function getResultSuccess(mixed $data): string
    {
        $result = ['status' => "success", 'result' => $data];

        return Collection::make($result)->toJson();
    }

    public static function getResultFail(string $message): string
    {
        $result = ['status' => "fail", 'result' => [], 'message' => $message];

        return Collection::make($result)->toJson();
    }

    public static function getResultException(array $exception): string
    {
        $result = ['status' => "exception", 'result' => [], 'exception' => $exception];

        return Collection::make($result)->toJson();
    }

    public static function getResultInvalid(array $invalid): string
    {
        $result = ['status' => "invalid", 'result' => [], 'params' => $invalid['params']];

        return Collection::make($result)->toJson();
    }

    public static function getResultForbidden(string $reason): string
    {
        $result = ['status' => "forbidden", 'result' => [], 'reason' => $reason];

        return Collection::make($result)->toJson();
    }
}
