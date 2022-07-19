<?php

declare(strict_types=1);

namespace App\Controllers\Validators;

use Respect\Validation\Validator;

/**
 * https://respect-validation.readthedocs.io/en/latest/concrete-api/
 * https://respect-validation.readthedocs.io/en/latest/list-of-rules/
 */
class ReviewValidator
{
    public const PAGE = 1;
    public const PER_PAGE = 15;
    public const SORT_FIELD = "r_time_created";
    public const SORT_ORDER = "desc";

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
            'status' => [
                'channel' => Validator::intVal()->between(0, 2),
                'optional' => true,
            ],
            'from' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
            'to' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
            'country' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
            'city' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
            'region' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
            'rating' => [
                'channel' => Validator::intVal()->between(1, 7),
                'optional' => true,
            ],
            'search' => [
                'channel' => Validator::stringVal(),
                'optional' => true,
            ],
        ];
    }

    public static function getReviewsByLocationIdValidator(): array
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

    public static function getReviewPostValidator(): array
    {
        return [
            'r_comment_reply' => [
                'channel' => Validator::stringVal(),
                'default' => '',
            ],
        ];
    }

    public static function getFiltersValidator(): array
    {
        return [
            'status' => [
                'channel' => Validator::intVal()->between(0, 2),
                'optional' => true,
            ],
            'from' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
            'to' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
            'city' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
            'region' => [
                'channel' => Validator::intVal()->positive(),
                'optional' => true,
            ],
            'rating' => [
                'channel' => Validator::intVal()->between(1, 7),
                'optional' => true,
            ],
            'search' => [
                'channel' => Validator::stringVal(),
                'optional' => true,
            ],
        ];
    }
}
