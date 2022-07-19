<?php

declare(strict_types=1);

namespace App\Helpers;

use Psr\Http\Message\ServerRequestInterface as Request;

class ParamsHelper
{
    public static function getParamsGet(Request $request, array $validators = [], string $key = ""): mixed
    {
        $params = $request->getQueryParams();
        $params = !empty($validators) ? self::validateParams($params, $validators) : $params;

        if (isset($params['invalid'])) {
            return $params;
        }

        return ($key && isset($params[$key])) ? $params[$key] : $params;
    }

    public static function getParamsBody(Request $request, array $validators = [], string $key = ""): mixed
    {
        $params = $request->getParsedBody();
        $params = !empty($validators) ? self::validateParams($params, $validators) : $params;

        if (isset($params['invalid'])) {
            return $params;
        }

        return ($key && isset($params[$key])) ? $params[$key] : $params;
    }

    public static function getParamAttributes(Request $request, string $key): mixed
    {
        return $request->getAttribute($key);
    }

    public static function getParamsTotal(Request $request, array $validators = [], string $key = ""): mixed
    {
        $paramsGet = $request->getQueryParams();
        $paramsBody = $request->getParsedBody();

        $params = [];
        $params = !empty($paramsGet) ? [...$paramsGet, ...$params] : $params;
        $params = !empty($paramsBody) ? [...$paramsBody, ...$params] : $params;
        $params = !empty($validators) ? self::validateParams($params, $validators) : $params;

        if (isset($params['invalid'])) {
            return $params;
        }

        return ($key && isset($params[$key])) ? $params[$key] : $params;
    }

    private static function validateParams(array $params, array $validators): array
    {
        $result = [];

        # проверка на "левые" параметры
        if ($diff = array_diff(array_keys($params), array_keys($validators))) {
            $result['invalid'] = true;
            $result['params'] = [...$diff];
        }

        # проверка валидатором
        foreach ($validators as $key => $validator) {
            if (!isset($params[$key]) && isset($validator['default'])) {
                $params[$key] = $validator['default'];
            }

            if (!isset($params[$key]) && isset($validator['optional'])) {
                continue;
            }

            if (isset($params[$key]) && isset($validator['channel'])) {
                if (!$validator['channel']->validate($params[$key])) {
                    $result['invalid'] = true;
                    $result['params'][] = $key;
                }
            }
        }

        return !empty($result) ? $result : $params;
    }
}
