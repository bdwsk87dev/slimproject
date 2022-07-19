<?php

declare(strict_types=1);

namespace App\Controllers\Services;

use App\Helpers\ResultHelper;
use App\Models\Location;
use App\Models\MediaFile;
use App\Models\Review;

class MainService
{
    /**
     * Получаем список данных по общей статистике
     */
    public static function getIndexData(array $params): string
    {
        $count = [
            'locations' => ['count' => Location::all()->count()],
            'reviews' => ['count' => Review::all()->count()],
            'mediaFiles' => ['count' => MediaFile::all()->count()],
        ];

        return ResultHelper::getResultSuccess($count);
    }
}
