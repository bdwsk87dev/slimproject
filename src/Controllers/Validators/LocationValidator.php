<?php

declare(strict_types=1);

namespace App\Controllers\Validators;

use Respect\Validation\Validator;

/**
 * https://respect-validation.readthedocs.io/en/latest/concrete-api/
 * https://respect-validation.readthedocs.io/en/latest/list-of-rules/
 */
class LocationValidator
{
    public const PAGE = 1;
    public const PER_PAGE = 15;
    public const SORT_FIELD = "l_title";
    public const SORT_ORDER = "asc";
    public const UKRAINE = 2;

    /**
     * Validator входящих параметров при получении фильтров локация
     */
    public static function getFiltersValidator(): array
    {
        return [
            'country' => [
                'channel' => Validator::intVal()->positive(),
                'default' => self::UKRAINE,
            ],
            'region' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
        ];
    }

    /**
     * Validator входящих параметров при получении/фильтрации списка локаций
     */
    public static function getAllValidator(): array
    {
        return [
            'page' => [
                'channel' => Validator::intVal()->positive(),
                'default' => self::PAGE,
            ],
            'per_page' => [
                'channel' => Validator::intVal()->positive(),
                'default' => self::PER_PAGE,
            ],
            'field' => [
                'channel' => Validator::alnum("_")->lowercase(),
                'default' => self::SORT_FIELD,
            ],
            'order' => [
                'channel' => Validator::stringVal()->between("asc", "desc"),
                'default' => self::SORT_ORDER,
            ],
            'country' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
            'region' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
            'city' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
            'status' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
            'office_status' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
            'search_field' => [
                'channel' => Validator::stringVal()->in(["store_code", "title", "address"]),
                'optional' => true,
            ],
            'search_text' => [
                'optional' => true,
            ],
        ];
    }

    /**
     * Validator входящих данных при создании локации
     */
    public static function createValidator(): array
    {
        return [
            'country' => [
                'channel' => Validator::intVal()->positive(),
                'default' => self::UKRAINE,
            ],
            'region' => [
                'channel' => Validator::intVal()->positive(),
            ],
            'city' => [
                'channel' => Validator::intVal()->positive(),
            ],
            'title' => [
                'channel' => Validator::notEmpty()
            ],
            'description' => [
                'optional' => true,
            ],
            'store_code' => [
                'channel' => Validator::intVal()->positive(),
            ],
            'website_url' => [
                'channel' => Validator::url(),
            ],
            'labels' => [
                'optional' => true,
            ],
            'office_status' => [
                'channel' => Validator::intVal()->positive(),
            ],
            'regular_hours' => [
                'channel' => Validator::intVal()->positive(),
            ],
            'phone' => [
                'channel' => Validator::intVal()->positive(),
            ],
            'lat_lng' => [
                'channel' => Validator::intVal()->positive(),
            ],
        ];
    }

    /**
     * Validator входящих данных при обновлении локации
     */
    public static function updateValidator(): array
    {
        return [
            'country' => [
                'channel' => Validator::intVal()->positive(),
                'default' => self::UKRAINE,
            ],
            'region' => [
                'channel' => Validator::intVal()->positive(),
            ],
            'city' => [
                'channel' => Validator::intVal()->positive(),
            ],
            'title' => [
                'channel' => Validator::notEmpty()
            ],
            'description' => [
                'optional' => true,
            ],
            'store_code' => [
                'channel' => Validator::intVal()->positive(),
            ],
            'website_url' => [
                'channel' => Validator::url(),
            ],
            'labels' => [
                'optional' => true,
            ],
            'office_status' => [
                'channel' => Validator::intVal()->positive(),
            ],
            'regular_hours' => [
                'channel' => Validator::intVal()->positive(),
            ],
            'phone' => [
                'channel' => Validator::intVal()->positive(),
            ],
            'lat_lng' => [
                'channel' => Validator::intVal()->positive(),
            ],
        ];
    }
}
