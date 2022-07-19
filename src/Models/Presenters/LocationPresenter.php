<?php

declare(strict_types=1);

namespace App\Models\Presenters;

use App\Models\Helpers\LocationHelper;

class LocationPresenter implements DefaultPresenter
{
    public static function present(mixed $item, array $params): array
    {
        $data = LocationHelper::getLocationData($item, $params);

        return [
            'id' => $data['id'],
            'name' => $data['name'],
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'store_code' => $data['store_code'],
            'website_url' => $data['website_url'],
            'labels' => $data['labels'],
            'office_status' => $data['office_status'],
            'categories' => $data['categories'],
            'regular_hours' => $data['regular_hours'],
            'phone' => $data['phone'],
            'lat_lng' => $data['lat_lng'],
            'address' => $data['address'],
            'metadata' => $data['metadata'],
            'logo' => $data['logo'],
        ];
    }

    public static function presentUpdate(mixed $item, array $params): array
    {
        $data = LocationHelper::getLocationUpdateData($item, $params);

        return [
            'title' => $data['title'],
            'description' => $data['description'],
            'store_code' => $data['store_code'],
            'website_url' => $data['website_url'],
            'labels' => $data['labels'],
            'office_status' => $data['office_status'],
            'categories' => $data['categories'],
            'regular_hours' => $data['regular_hours'],
            'phone' => $data['phone'],
            'lat_lng' => $data['lat_lng'],
            'address' => $data['address'],
        ];
    }

    public static function presentCreate(mixed $item, array $params): array
    {
        $data = LocationHelper::getLocationUpdateData($item, $params);

        return [
            'title' => $data['title'],
            'description' => $data['description'],
            'store_code' => $data['store_code'],
            'website_url' => $data['website_url'],
            'labels' => $data['labels'],
            'office_status' => $data['office_status'],
            'categories' => $data['categories'],
            'regular_hours' => $data['regular_hours'],
            'phone' => $data['phone'],
            'lat_lng' => $data['lat_lng'],
            'address' => $data['address'],
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
