<?php

declare(strict_types=1);

namespace App\Controllers\Services;

use App\Models\LocationCity;
use App\Models\LocationRegion;
use App\Models\Helpers\ReviewHelper;
use App\Models\Presenters\LocationCityPresenter;
use App\Models\Presenters\LocationRegionPresenter;
use App\Models\Presenters\PagingPresenter;
use App\Models\ReviewFilters;
use App\Helpers\ResultHelper;
use App\Models\Review;

class ReviewService
{

    public static function getAllData(array $params): string
    {
        $columns = [
            'r_name',
            'r_id',
            'r_comment',
            'r_star_rating',
            'UNIX_TIMESTAMP(r_time_created) AS time_created',
            'r_reviewer_photo',
            'r_reviewer_name',
            'r_comment_reply',
            'UNIX_TIMESTAMP(r_time_reply) AS time_reply',
            'l_title',
            'l_address', //JSON_ARRAY(l_address)
            'l_metadata', //JSON_ARRAY(l_metadata)
            'f_region_id',
            'f_city_id',
        ];

        $str_columns = implode(',', $columns);
        $reviewsPaging = ReviewFilters::query()
            ->selectRaw($str_columns)
            ->scopes(["filters" => [$params]])
            ->join('locations AS l', 'f_location_id', '=', 'l.l_id')
            ->orderBy($params['field'], $params['order'])
            ->paginate($params['per_page'], $str_columns, null, $params['page']);

        $reviews = $reviewsPaging->items();

        if (!$reviews) {
            return ResultHelper::getResultFail("Data not found!");
        }

        $paging = PagingPresenter::present($reviewsPaging, $params);

        $reviews = ReviewHelper::transformCollection($reviews);
        return ResultHelper::getResultSuccess(['paging' => $paging, 'reviews' => $reviews]);
    }

    public static function getOneData(array $params): string
    {
        $review = Review::query()->find($params['id']);

        return $review
            ? ResultHelper::getResultSuccess($review)
            : ResultHelper::getResultFail("Data not found!");
    }

    public static function getAllByLocationId(array $params): string
    {
        $result = Review::query()
            ->where(Review::$foreignKey, $params['id'])
            ->orderBy($params['field'], $params['order'])
            ->paginate($params['per_page'], ["*"], null, $params['page'])
            ->items();

        return $result
            ? ResultHelper::getResultSuccess($result)
            : ResultHelper::getResultFail("Data not found!");
    }

    public static function updateReview(array $params): string
    {
        $reviewId = $params['id'];
        $review = Review::query()->find($reviewId);

        if (!$review) {
            return ResultHelper::getResultFail("Review wasn't found!");
        }

        $review->r_comment_reply = $params['r_comment_reply'] ?? '';
        $review->r_time_reply = date('Y-m-d H:i:s');

        $result = $review->save();

        return $result
            ? ResultHelper::getResultSuccess($result)
            : ResultHelper::getResultFail("Review wasn't updated");
    }

    public static function getFiltersData(array $params): string
    {
        $filters = [
            'region' => self::getRegions($params),
            'city' => self::getCities($params),
            'status' => self::getStatuses($params),
            'rating' => self::getCommentsRating($params),
            'from' => self::getFrom($params),
            'to' => self::getTo($params),
            'search' => self::getSearch($params),
        ];

        return ResultHelper::getResultSuccess(['filters' => $filters]);
    }

    /**
     * Получаем список регионов с учетом параметров
     */
    private static function getRegions(array $params): array
    {
        $regions = LocationRegion::query()->scopes(['region' => [$params]])->get()->all();

        return LocationRegionPresenter::presentCollection($regions, $params);
    }

    /**
     * Получаем список городов с учетом параметров
     */
    private static function getCities(array $params): array
    {
        $cities = LocationCity::query()->scopes(['city' => [$params]])->get()->all();

        return LocationCityPresenter::presentCollection($cities, $params);
    }

    private static function getStatuses(array $params): array
    {
        $texts = static::getAllValuesInSearchFilters($params);

        $statuses = [
            0 => [
                'code' => 0,
                'name' => $texts['all'] ?? 'Все',
            ],
            1 => [
                'code' => 1,
                'name' => $texts['without_answer'] ?? 'Без ответа',
            ],
            2 => [
                'code' => 2,
                'name' => $texts['with_answer'] ?? 'С ответом',
            ]
        ];

        return isset($params['status']) && isset($statuses[$params['status']]) ?
            [$params['status'] => $statuses[$params['status']]] : $statuses;
    }

    private static function getCommentsRating(array $params): array
    {
        $texts = static::getAllValuesInSearchFilters($params);
        $commens_rating = [
            0 => [
                'code' => 6,
                'name' => $texts['without_comments'] ?? 'Без комментариев',
            ],
            1 => [
                'code' => 7,
                'name' => $texts['with_comments'] ?? 'С комментарием',
            ],
            2 => [
                'code' => 1,
                'name' => '1 ' . $texts['star'] ?? 'звезда',
            ],
            3 => [
                'code' => 2,
                'name' => '2 ' . $texts['star_'] ?? 'звезды',
            ],
            4 => [
                'code' => 3,
                'name' => '3 ' . $texts['star_'] ?? 'звезды',
            ],
            5 => [
                'code' => 4,
                'name' => '4 ' . $texts['star_'] ?? 'звезды',
            ],
            6 => [
                'code' => 5,
                'name' => '5 ' . $texts['stars'] ?? 'звезд',
            ]
        ];

        return isset($params['rating']) && isset($commens_rating[$params['rating']]) ?
            [$params['rating'] => $commens_rating[$params['rating']]] : $commens_rating;
    }

    private static function getFrom(array $params): array
    {
        return $params['from'] ?? [];
    }

    private static function getTo(array $params): array
    {
        return $params['to'] ?? [];
    }

    private static function getSearch(array $params): array
    {
        return $params['search'] ?? [];
    }

    private static function getAllValuesInSearchFilters(array $params): array
    {
        static $searchFiltersTexts;

        if (!isset($searchFiltersTexts['search_filter'])) {
            $searchFiltersTexts = lang("{$params['lang']}/reviews");

            if (!isset($searchFiltersTexts['search_filter'])) {
                $searchFiltersTexts = [];
            }
        }

        return $searchFiltersTexts['search_filter'];
    }

}