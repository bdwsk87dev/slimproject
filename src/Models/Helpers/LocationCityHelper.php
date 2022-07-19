<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use App\Models\LocationCity;

class LocationCityHelper
{
    public static function getLocationCityData(LocationCity $item, array $params): array
    {
        return [
            'id' => self::getId($item),
            'country_id' => self::getCountryId($item),
            'region_id' => self::getRegionId($item),
            'name' => self::getName($item),
            'is_active' => self::getIsActive($item),
        ];
    }

    private static function getId(LocationCity $item): int
    {
        return $item->getId();
    }

    private static function getCountryId(LocationCity $item): int
    {
        return $item->getCountryId();
    }

    private static function getRegionId(LocationCity $item): int
    {
        return $item->getRegionId();
    }

    private static function getName(LocationCity $item): string
    {
        return $item->getName();
    }

    private static function getIsActive(LocationCity $item): int
    {
        return $item->getIsActive();
    }
}
