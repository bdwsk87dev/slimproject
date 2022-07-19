<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use App\Models\LocationOfficeStatus;

class LocationOfficeStatusHelper
{
    public static function getLocationOfficeStatusData(LocationOfficeStatus $item, array $params): array
    {
        return [
            'id' => self::getId($item),
            'code' => self::getCode($item),
            'name' => self::getName($item, $params),
        ];
    }

    private static function getId(LocationOfficeStatus $item): int
    {
        return $item->getId();
    }

    private static function getCode(LocationOfficeStatus $item): string
    {
        return $item->getCode();
    }

    private static function getName(LocationOfficeStatus $item, array $params): string
    {
        return $item->getName($params['lang']);
    }
}
