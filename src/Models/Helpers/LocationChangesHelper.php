<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use App\Models\Location;
use App\Models\LocationChanges;

class LocationChangesHelper
{
    public static function fill(Location $location, array $params, string $type): LocationChanges
    {
        $data = self::getDataField($location, $params, $type);
        $user = app()->getContainer()->has("user") ? app()->getContainer()->get("user") : null;
        $changes = [
            'location_id' => $location->getId(),
            'location_name' => $location->getName(),
            'user_id' => $user ? $user->getId() : 1,
            'user_ip' => inet_pton($params['ip_address']),
            'type' => $type,
            'data' => $data,
        ];

        $locationChanges = new LocationChanges();

        foreach (LocationChanges::$fields as $key => $field) {
            $locationChanges->$field = $changes[$key];
        }

        return $locationChanges;
    }

    private static function getDataField(Location $location, array $params, string $type): string
    {
        return match ($type) {
            "update" => self::getUpdatedFields($location, $params),
            default => $location->toJson(),
        };
    }

    private static function getUpdatedFields(Location $location, array $params): string
    {
        return "";
    }
}
