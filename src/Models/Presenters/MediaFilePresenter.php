<?php

declare(strict_types=1);

namespace App\Models\Presenters;

use App\Models\Helpers\MediaFileHelper;

class MediaFilePresenter implements DefaultPresenter
{
    public static function present(mixed $item, array $params): array
    {
        $data = MediaFileHelper::getMediaFileData($item, $params);

        return [
            'id' => $data['id'],
            'location_id' => $data['location_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'type' => $data['type'],
            'format' => $data['format'],
            'category' => $data['category'],
            'google_url' => $data['google_url'],
            'thumbnail_url' => $data['thumbnail_url'],
            'time_created' => $data['time_created'],
            'view_count' => $data['view_count'],
            'customer' => $data['customer'],
        ];
    }

    public static function presentUpdate(mixed $item, array $params): array
    {
        $data = MediaFileHelper::getMediaFileData($item, $params);

        return [
            'format' => $data['format'],
            'category' => $data['category'],
            'google_url' => $data['google_url'],
            'view_count' => $data['view_count'],
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

    public static function presentUpdateCollection(array $collection, array $params): array
    {
        if (!empty($collection)) {
            return array_map(function ($item) use($params) {
                return self::presentUpdate($item, $params);
            }, $collection);
        }

        return [];
    }
}
