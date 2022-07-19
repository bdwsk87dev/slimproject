<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use App\Models\LocationStatus;

class LocationStatusHelper
{
    public static function getLocationStatusData(LocationStatus $item, array $params): array
    {
        return [
            'id' => self::getId($item),
            'code' => self::getCode($item),
            'name' => self::getName($item, $params),
        ];
    }

    private static function getId(LocationStatus $item): int
    {
        return $item->getId();
    }

    private static function getCode(LocationStatus $item): string
    {
        return $item->getCode();
    }

    private static function getName(LocationStatus $item, array $params): string
    {
        return $item->getName($params['lang']);
    }
}
