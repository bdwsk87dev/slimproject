<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use App\Models\LocationCountry;

class LocationCountryHelper
{
    public static function getLocationCountryData(LocationCountry $item, array $params): array
    {
        return [
            'id' => self::getId($item),
            'name' => self::getName($item, $params),
            'is_undefined' => self::getIsUndefined($item),
            'is_active' => self::getIsActive($item),
        ];
    }

    private static function getId(LocationCountry $item): int
    {
        return $item->getId();
    }

    private static function getName(LocationCountry $item, array $params): string
    {
        return $item->getName($params['lang']);
    }

    private static function getIsUndefined(LocationCountry $item): int
    {
        return $item->getIsUndefined();
    }

    private static function getIsActive(LocationCountry $item): int
    {
        return $item->getIsActive();
    }
}