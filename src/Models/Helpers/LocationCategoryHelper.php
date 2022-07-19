<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use App\Models\LocationCategory;

class LocationCategoryHelper
{
    public static function getLocationCategoryData(LocationCategory $item, array $params): array
    {
        return [
            'code' => self::getCode($item),
            'name' => self::getName($item, $params),
        ];
    }

    private static function getCode(LocationCategory $item): string
    {
        return $item->getCode();
    }

    private static function getName(LocationCategory $item, array $params): string
    {
        return $item->getName($params['lang']);
    }
}
