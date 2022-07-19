<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use App\Models\Location;
use App\Models\LocationCategory;
use App\Models\Presenters\LocationCategoryPresenter;

class LocationHelper
{
    public static function fillLocationData(array $params): array
    {
        return [];
    }

    public static function getLocationData(Location $item, array $params): array
    {
        return [
            'id' => self::getId($item),
            'name' => self::getName($item),
            'title' => self::getTitle($item),
            'description' => self::getDescription($item),
            'status' => self::getStatus($item, $params),
            'store_code' => self::getStoreCode($item),
            'website_url' => self::getWebsiteUrl($item),
            'labels' => self::getLabels($item),
            'office_status' => self::getOfficeStatus($item, $params),
            'categories' => self::getCategories($item),
            'regular_hours' => self::getRegularHours($item),
            'phone' => self::getPhone($item),
            'lat_lng' => self::getLatLng($item),
            'address' => self::getAddress($item, $params),
            'metadata' => self::getMetadata($item),
            'logo' => self::getLogo($item),
        ];
    }

    public static function getLocationUpdateData(Location $item, array $params): array
    {
        return [
            'title' => self::getTitle($item),
            'description' => self::getDescription($item),
            'store_code' => self::getStoreCode($item),
            'website_url' => self::getWebsiteUrl($item),
            'labels' => self::getLabels($item),
            'office_status' => self::getOfficeStatusUpdate($item),
            'categories' => self::getCategoriesUpdate($item, $params),
            'regular_hours' => self::getRegularHours($item),
            'phone' => self::getPhone($item),
            'lat_lng' => self::getLatLng($item),
            'address' => self::getAddressUpdate($item),
        ];
    }

    public static function getLocationCreateData(Location $item, array $params): array
    {
        return [
            'title' => self::getTitle($item),
            'description' => self::getDescription($item),
            'store_code' => self::getStoreCode($item),
            'website_url' => self::getWebsiteUrl($item),
            'labels' => self::getLabels($item),
            'office_status' => self::getOfficeStatusUpdate($item),
            'categories' => self::getCategoriesUpdate($item, $params),
            'regular_hours' => self::getRegularHours($item),
            'phone' => self::getPhone($item),
            'lat_lng' => self::getLatLng($item),
            'address' => self::getAddressUpdate($item),
        ];
    }

    private static function getId(Location $item): string
    {
        return $item->getId();
    }

    private static function getName(Location $item): string
    {
        return $item->getName();
    }

    private static function getTitle(Location $item): string
    {
        return $item->getTitle();
    }

    private static function getDescription(Location $item): ?string
    {
        return $item->getDescription() ?: null;
    }

    private static function getStatus(Location $item, array $params): array
    {
        $status = $item->getStatus();

        return [
            'id' => $status->getId(),
            'code' => $status->getCode(),
            'text' => $status->getName($params['lang']),
        ];
    }

    private static function getStoreCode(Location $item): ?int
    {
        return $item->getStoreCode() ?: null;
    }

    private static function getWebsiteUrl(Location $item): ?string
    {
        return $item->getWebsiteUrl() ?: null;
    }

    private static function getLabels(Location $item): ?array
    {
        return json_decode($item->getLabels(), true);
    }

    private static function getOfficeStatus(Location $item, array $params): array
    {
        $status = $item->getOfficeStatus();

        return [
            'id' => $status->getId(),
            'code' => $status->getCode(),
            'text' => $status->getName($params['lang']),
        ];
    }

    private static function getOfficeStatusUpdate(Location $item): int
    {
        return $item->getOfficeStatus()->getId();
    }

    private static function getCategories(Location $item): ?array
    {
        return json_decode($item->getCategories(), true);
    }

    private static function getCategoriesUpdate(Location $item, array $params): ?array
    {
        $categories = json_decode($item->getCategories(), true);

        if (is_null($categories)) {
            $primary = LocationCategoryPresenter::present(
                LocationCategory::query()->find(LocationCategory::CODE_PRIMARY_DEFAULT), $params
            );
            $additional = LocationCategoryPresenter::present(
                LocationCategory::query()->find(LocationCategory::CODE_ADDITIONAL_DEFAULT), $params
            );
            $categories = [
                'primary' => [
                    'code' => $primary['code'],
                    'text' => $primary['name'],
                ],
                'additional' => [[
                    'code' => $additional['code'],
                    'text' => $additional['name'],
                ]],
            ];
        }

        return $categories;
    }

    private static function getRegularHours(Location $item): ?array
    {
        return json_decode($item->getRegularHours(), true);
    }

    private static function getPhone(Location $item): ?array
    {
        return json_decode($item->getPhone(), true);
    }

    private static function getLatLng(Location $item): ?array
    {
        return json_decode($item->getLatLng(), true);
    }

    private static function getAddress(Location $item, array $params): array
    {
        return [
            'country' => $item->getCountry()->getName($params['lang']),
            'region' => $item->getRegion()->getName($params['lang']),
            'city' => $item->getCity()->getName(),
            'streets' => json_decode($item->getAddress(), true)['streets'],
            'postal' => json_decode($item->getAddress(), true)['postal'],
        ];
    }

    private static function getAddressUpdate(Location $item): array
    {
        return [
            'region' => $item->getRegion()->getId(),
            'city' => $item->getCity()->getId(),
            'streets' => json_decode($item->getAddress(), true)['streets'],
            'postal' => json_decode($item->getAddress(), true)['postal'],
        ];
    }

    private static function getMetadata(Location $item): ?array
    {
        return json_decode($item->getMetadata(), true);
    }

    private static function getLogo(Location $item): ?string
    {
        return $item->getLogo() ?: null;
    }
}
