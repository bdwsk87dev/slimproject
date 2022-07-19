<?php

declare(strict_types=1);

namespace App\Models\Presenters;

use App\Models\Helpers\LocationCountryHelper;

class LocationCountryPresenter implements DefaultPresenter
{
    public static function present(mixed $item, array $params): array
    {
        $data = LocationCountryHelper::getLocationCountryData($item, $params);

        return [
            'id' => $data['id'],
            'name' => $data['name'],
            'is_undefined' => $data['is_undefined'],
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
