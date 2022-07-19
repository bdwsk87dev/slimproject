<?php

declare(strict_types=1);

namespace App\Models\Presenters;

use App\Models\Helpers\LocationCityHelper;

class LocationCityPresenter implements DefaultPresenter
{
    public static function present(mixed $item, array $params): array
    {
        $data = LocationCityHelper::getLocationCityData($item, $params);

        return [
            'id' => $data['id'],
            'country_id' => $data['country_id'],
            'region_id' => $data['region_id'],
            'name' => $data['name'],
            'is_active' => $data['is_active'],
        ];
    }

    public static function presentCollection(array $collection, array $params): array
    {
        if (!empty($collection)) {
            return array_map(function ($item) use($params) {
                return self::present($item, $params);
            }, $collection);
        }

        return [];
    }
}
