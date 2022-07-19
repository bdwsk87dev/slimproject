<?php

declare(strict_types=1);

namespace App\Models\Presenters;

use App\Models\Helpers\LocationCategoryHelper;

class LocationCategoryPresenter implements DefaultPresenter
{
    public static function present(mixed $item, array $params): array
    {
        $data = LocationCategoryHelper::getLocationCategoryData($item, $params);

        return [
            'code' => $data['code'],
            'name' => $data['name'],
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
