<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use App\Models\MediaFile;

class MediaFileHelper
{
    public static function fillMediaFileData(array $params): array
    {
        return [];
    }

    public static function getMediaFileData(MediaFile $item, array $params): array
    {
        return [
            'id' => self::getId($item),
            'location_id' => self::getLocationId($item),
            'name' => self::getName($item),
            'description' => self::getDescription($item),
            'type' => self::getType($item),
            'format' => self::getFormat($item),
            'category' => self::getCategory($item),
            'google_url' => self::getGoogleUrl($item),
            'thumbnail_url' => self::getThumbnailUrl($item),
            'time_created' => self::getTimeCreated($item),
            'view_count' => self::getViewCount($item),
            'customer' => self::getCustomer($item),
        ];
    }

    private static function getId(MediaFile $item): string
    {
        return $item->getId();
    }

    private static function getLocationId(MediaFile $item): string
    {
        return $item->getLocationId();
    }

    private static function getName(MediaFile $item): string
    {
        return $item->getName();
    }

    private static function getDescription(MediaFile $item): ?string
    {
        return $item->getDescription() ?: null;
    }

    private static function getType(MediaFile $item): string
    {
        return $item->getType();
    }

    private static function getFormat(MediaFile $item): string
    {
        return $item->getFormat();
    }

    private static function getCategory(MediaFile $item): ?string
    {
        return $item->getCategory() ?: null;
    }

    private static function getGoogleUrl(MediaFile $item): string
    {
        return $item->getGoogleUrl();
    }

    private static function getThumbnailUrl(MediaFile $item): string
    {
        return $item->getThumbnailUrl();
    }

    private static function getTimeCreated(MediaFile $item): string
    {
        return $item->getTimeCreated();
    }

    private static function getViewCount(MediaFile $item): int
    {
        return $item->getViewCount();
    }

    private static function getCustomer(MediaFile $item): ?array
    {
        return json_decode($item->getCustomer(), true);
    }
}
