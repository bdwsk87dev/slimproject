<?php

declare(strict_types=1);

namespace App\Controllers\Validators;

use Respect\Validation\Validator;

/**
 * https://respect-validation.readthedocs.io/en/latest/concrete-api/
 * https://respect-validation.readthedocs.io/en/latest/list-of-rules/
 */
class MediaFileValidator
{
    public const PAGE = 1;
    public const PER_PAGE = 15;
    public const SORT_FIELD = "mf_time_created";
    public const SORT_ORDER = "desc";

    /**
     * Validator входящих параметров при получении/фильтрации списка медиа файлов
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
        ];
    }

    /**
     * Validator входящих параметров при получении/фильтрации списка медиа файлов для конкретной локации
     */
    public static function getAllByLocationIdValidator(): array
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
        ];
    }

    /**
     * Validator входящих данных при создании медиа файла
     */
    public static function createValidator(): array
    {
        return [

        ];
    }

    /**
     * Validator входящих данных при обновлении медиа файла
     */
    public static function updateValidator(): array
    {
        return [

        ];
    }
}
