<?php

declare(strict_types=1);

namespace App\Controllers\Services;

use App\Helpers\ResultHelper;

class LangService
{
    public static function getAllData(array $params): string
    {
        try {
            $result = lang(implode(".", $params));
        } catch (\Exception) {
            return ResultHelper::getResultFail(sprintf("Lang file for %s not found!", implode("/", $params)));
        }

        return !empty($result)
            ? ResultHelper::getResultSuccess($result)
            : ResultHelper::getResultFail(sprintf("Data for %s not found!", implode("/", $params)));
    }

    public static function getOneData(array $params): string
    {
        $base = $params;
        $part = array_pop($params);

        try {
            $result = lang(implode(".", $params));
        } catch (\Exception) {
            return ResultHelper::getResultFail(sprintf("Lang file for %s not found!", implode("/", $params)));
        }

        return (isset($result[$part]) && !empty($result[$part]))
            ? ResultHelper::getResultSuccess($result)
            : ResultHelper::getResultFail(sprintf("Data for %s not found!", implode("/", $base)));
    }
}
