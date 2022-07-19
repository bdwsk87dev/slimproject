<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use App\Models\LocationRegion;

class LocationRegionHelper
{
    public static function getLocationRegionData(LocationRegion $item, array $params): array
    {
        return [
            'id' => self::getId($item),
            'country_id' => self::getCountryId($item),
            'name' => self::getName($item, $params),
            'is_undefined' => self::getIsUndefined($item),
            'is_active' => self::getIsActive($item),
        ];
    }

    private static function getId(LocationRegion $item): int
    {
        return $item->getId();
    }

    private static function getCountryId(LocationRegion $item): int
    {
        return $item->getCountryId();
    }

    private static function getName(LocationRegion $item, array $params): string
    {
        return $item->getName($params['lang']);
    }

    private static function getIsUndefined(LocationRegion $item): int
    {
        return $item->getIsUndefined();
    }

    private static function getIsActive(LocationRegion $item): int
    {
        return $item->getIsActive();
    }
}
